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

final class LinkReferenceDefinition extends LeafBlock {
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
    list($first, $without_first) = $lines->getFirstLineAndRest();
    $matches = [];
    if (
      \preg_match(
        '/^(?<prefix> {0,3}\[(?<label> *([^ \]]+ *)+)\]: *)(?<rest>.*)$/',
        $first,
        $matches,
      ) !== 1
    ) {
      return null;
    }

    $label = $matches['label'];

    $rest = $matches['rest'] ?? '';
    if ($rest !== '') {
      $lines = $lines->withoutFirstLinePrefix($matches['prefix']);
    } else {
      $lines = $without_first;
    }

    $result = self::consumeDestination($lines->withLeftTrimmedFirstLine());
    if ($result === null) {
      return null;
    }

    list($destination, $lines) = $result;
    $lines = $lines->withLeftTrimmedFirstLine();
    if ($lines->getFirstLine() === '') {
      list($_, $lines) = $lines->getFirstLineAndRest();
      $lines = $lines->withLeftTrimmedFirstLine();
    }

    $title = null;
    $result = self::consumeTitle($lines);
    if ($result !== null) {
      list($title, $lines) = $result;
    }

    list($line, $lines) =
      $lines->withLeftTrimmedFirstLine()->getFirstLineAndRest();
    if ($line !== '') {
      return null;
    }

    $def = new self($label, $destination, $title);
    $context->addLinkReferenceDefinition($def);
    return tuple($def, $lines);
  }

  private static function consumeDestination(
    Lines $lines,
  ): ?(string, Lines) {
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
    $out = consume_link_title($lines->toString());
    if ($out === null) {
      return null;
    }
    list($title, $consumed_bytes) = $out;
    return tuple($title, $lines->withoutFirstNBytes($consumed_bytes));
  }

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
