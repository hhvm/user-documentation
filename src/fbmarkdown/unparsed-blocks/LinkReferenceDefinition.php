<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\Markdown\UnparsedBlocks;

use type Facebook\Markdown\Blocks\LinkReferenceDefinition as ASTNode;
use function Facebook\Markdown\_Private\{
  consume_link_destination,
  consume_link_title,
};
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

class LinkReferenceDefinition extends LeafBlock implements BlockProducer {
  public function __construct(
    private string $label,
    private string $destination,
    private ?string $title,
  ) {
  }

  public function getLabel(): string {
    return $this->label;
  }

  public function getDestination(): string {
    return $this->destination;
  }

  public function getTitle(): ?string {
    return $this->title;
  }

  public function getKey(): string {
    return self::normalizeKey($this->getLabel());
  }

  public static function normalizeKey(string $in): string {
    return $in
      |> Str\trim($$)
      |> \mb_convert_case($$, MB_CASE_LOWER, "UTF-8")
      |> \preg_replace('/\s+/', ' ', $$);
  }

  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(Block, Lines) {
    if ($context->isInParagraphContinuation()) {
      return null;
    }

    $label = self::consumeLabel($lines);
    if ($label === null) {
      return null;
    }
    list($label, $lines) = $label;

    $first = $lines->getFirstLine();
    if (($first[0] ?? null) !== ':') {
      return null;
    }

    $lines = $lines->withoutFirstLinePrefix(':');

    $result = self::consumeOptionalWhitespaceAndDestination($lines);
    if ($result === null) {
      return null;
    }

    list($destination, $lines) = $result;

    $title = self::consumeWhitespaceAndTitle($lines);
    if ($title !== null) {
      list($title, $rest) = $title;
      if (self::consumeEnd($rest) === null) {
        $title = null;
      } else {
        $lines = $rest;
      }
    } else {
      // refine from ?(tuple|string) to ?string
      $title = null;
    }

    $lines = self::consumeEnd($lines);
    if ($lines === null) {
      return null;
    }

    $def = new self($label, $destination, $title);
    $context->addLinkReferenceDefinition($def);
    return tuple($def, $lines);
  }

  private static function consumeEnd(Lines $lines): ?Lines {
    $lines = $lines->withLeftTrimmedFirstLine();
    list($first, $lines) = $lines->getFirstLineAndRest();
    if ($first !== '') {
      return null;
    }
    return $lines;
  }

  /** Consume whitespace, including at most one newline */
  private static function consumeWhitespace(
    Lines $lines,
  ): ?Lines {
    if ($lines->isEmpty()) {
      return null;
    }

    list($first, $rest) = $lines->getFirstLineAndRest();
    $len = Str\length($first);
    for ($i = 0; $i < $len; ++$i) {
      $char = $first[$i];
      if ($char === ' ' || $char === "\t") {
        continue;
      }
      return $lines->withoutFirstNBytes($i);
    }

    // entire first line was whitespace
    if ($rest->isEmpty()) {
      return $rest;
    }
    return $rest->withLeftTrimmedFirstLine();
  }

  private static function consumeOptionalWhitespaceAndDestination(
    Lines $lines,
  ): ?(string, Lines) {
    $lines = self::consumeWhitespace($lines) ?? $lines;
    return self::consumeDestination($lines);
  }

  private static function consumeWhitespaceAndTitle(
    Lines $lines,
  ): ?(string, Lines) {
    $lines = self::consumeWhitespace($lines);
    if ($lines === null) {
      return null;
    }

    return self::consumeTitle($lines);
  }

  private static function consumeLabel(
    Lines $lines,
  ): ?(string, Lines) {
    list($column, $first_raw, $_) = $lines->getColumnFirstLineAndRest();
    list($_, $first, $_) = Lines::stripUpToNLeadingWhitespace(
      $first_raw,
      3,
      $column,
  );

    if (!Str\starts_with($first, '[')) {
      return null;
    }

    $label = '';
    $lines = $lines->withoutFirstNBytes((int) Str\search($first_raw, '[') + 1);

    while (!$lines->isEmpty()) {
      list($line, $rest) = $lines->getFirstLineAndRest();
      $len = Str\length($line);
      for ($i = 0; $i < $len; ++$i) {
        $char = $line[$i];
        if ($char === '[') {
          return null;
        }
        if ($char === ']') {
          break;
        }
        if ($char === "\\") {
          if ($i + 1 < $len) {
            $label .= "\\".$line[$i + 1];
            ++$i;
            continue;
          }
        }
        $label .= $char;
      }

      if ($i < $len) {
        // We matched the ']'
        $lines = $lines->withoutFirstNBytes($i + 1);
        break;
      }

      if ($rest->isEmpty()) {
        return null;
      }
      $lines = $rest;
    }

    if (Str\trim($label) === '') {
      return null;
    }

    return tuple($label, $lines);
  }

  private static function consumeDestination(
    Lines $lines,
  ): ?(string, Lines) {
    if ($lines->isEmpty()) {
      return null;
    }

    $out = consume_link_destination($lines->toString());
    if ($out === null) {
      return null;
    }
    list($destination, $consumed_bytes) = $out;
    return tuple($destination, $lines->withoutFirstNBytes($consumed_bytes));
  }

  private static function consumeTitle(
    Lines $lines,
  ): ?(string, Lines) {
    if ($lines->isEmpty()) {
      return null;
    }

    list($first, $rest) = $lines->getFirstLineAndRest();
    if ($first === '') {
      $lines = $rest;
    }

    if ($lines->isEmpty()) {
      return null;
    }

    $out = consume_link_title($lines->toString());
    if ($out === null) {
      return null;
    }
    list($title, $consumed_bytes) = $out;
    return tuple($title, $lines->withoutFirstNBytes($consumed_bytes));
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    $title = $this->title;
    if ($title !== null) {
      $title = Inlines\parse($ctx, $title);
    } else {
      // No-op, but avoids null|string|vec<Inline> type
      $title = null;
    }
    return new ASTNode($this->label, $this->destination, $title);
  }
}
