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

use type Facebook\GFM\Blocks\Heading as ASTHeading;
use namespace Facebook\GFM\Inlines;

use namespace HH\Lib\{C, Str, Vec};

final class SetextHeading extends LeafBlock {
  public function __construct(private int $level, private string $heading) {
  }

  public static function consume(
    Context $context,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    for ($idx = 1; $idx < C\count($lines); ++$idx) {
      $line = $lines[$idx];
      if ($line === '') {
        return null;
      }

      $matches = [];
      if (\preg_match('/^ {0,3}(?<level>=+|-+) *$/', $line, $matches) === 1) {
        $level = $matches['level'][0] === '=' ? 1 : 2;
        return tuple(
          new self($level, Str\join(Vec\take($lines, $idx), "\n")),
          Vec\drop($lines, $idx + 1),
        );
      }
      if (
        !self::isParagraphContinuationText($context, Vec\drop($lines, $idx))
      ) {
        return null;
      }
    }
    return null;
  }

  public function withParsedInlines(Inlines\Context $ctx): ASTHeading {
    return new ASTHeading(
      $this->level,
      Inlines\Inline::parse($ctx, $this->heading),
    );
  }
}
