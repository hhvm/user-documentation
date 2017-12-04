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

namespace Facebook\GFM\UnparsedBlocks;

use namespace HH\Lib\{C, Str, Vec};
use type Facebook\GFM\Blocks\Heading as ASTHeading;
use namespace Facebook\GFM\Inlines;

final class ATXHeading extends LeafBlock {
  const string PATTERN = '/^ {0,3}(?<level>#{1,6}) (?<title>.+)$/';

  public function __construct(private int $level, private string $heading) {
  }

  public static function consume(
    Context $_context,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $first = C\firstx($lines);
    $rest = Vec\drop($lines, 1);

    $matches = [];
    $result = \preg_match(self::PATTERN, $first, $matches);
    if ($result !== 1) {
      return null;
    }

    $level = Str\length($matches['level']);

    $title = $matches['title']
      |> Str\trim_right($$, '#')
      |> Str\trim_right($$, ' ');

    return tuple(new self($level, $title), $rest);
  }

  public function withParsedInlines(Inlines\Context $ctx): ASTHeading {
    return new ASTHeading(
      $this->level,
      Inlines\parse($ctx, $this->heading),
    );
  }
}
