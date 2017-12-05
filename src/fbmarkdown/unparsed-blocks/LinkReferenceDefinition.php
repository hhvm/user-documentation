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

  public static function consume(
    Context $_,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $first = C\firstx($lines);
    $matches = [];
    if (
      \preg_match(
        '/^ {0,3}\[(?<label> *([^ \]]+ *)+)\]: *(?<rest>.*)$/',
        $first,
        $matches,
      ) !== 1
    ) {
      return null;
    }

    $label = $matches['label']
      |> Str\trim($$)
      |> \mb_convert_case($$, MB_CASE_LOWER, "UTF-8")
      |> \preg_replace('/\s+/', ' ', $$);

    $rest = $matches['rest'] ?? '';
    if ($rest !== '') {
      $lines = Vec\concat(
        vec[$rest],
        Vec\drop($lines, 1),
      );
    } else {
      $lines = Vec\drop($lines, 1);
    }

    $result = self::consumeDestination($lines);
    if ($result === null) {
      return null;
    }
    list($destination, $lines) = $result;

    $title = null;
    $result = self::consumeTitle($lines);
    if ($result !== null) {
      list($title, $lines) = $result;
    }

    return tuple(
      new self($label, $destination, $title),
      $lines,
    );
  }

  private static function consumeDestination(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $out = consume_link_destination(Str\join($lines, "\n"));
    if ($out === null) {
      return null;
    }
    list($destination, $rest) = $out;
    return tuple($destination, Str\split($rest, "\n"));
  }

  private static function consumeTitle(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $out = consume_link_title(Str\join($lines, "\n"));
    if ($out === null) {
      return null;
    }
    list($title, $rest) = $out;
    return tuple($title, Str\split($rest, "\n"));
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
