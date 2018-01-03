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

use type Facebook\Markdown\Blocks\ThematicBreak as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

class ThematicBreak extends LeafBlock implements BlockProducer {

  <<__Memoize>>
  private static function getPattern(): string {
    $pattern = '/^ {0,3}';

    return vec['-', '_', '*']
      |> Vec\map($$, $c ==> \preg_quote($c, '/'))
      |> Vec\map($$, $c ==> '('.$c."[ \\t]*){3,}")
      |> Str\join($$, '|')
      |> '/^ {0,3}('.$$.')$/';
  }

  public static function consume(
    Context $_,
    Lines $lines,
  ): ?(Block, Lines) {
    list($first, $rest) = $lines->getFirstLineAndRest();
    if (\preg_match(self::getPattern(), $first) !== 1) {
      return null;
    }
    return tuple(new self(), $rest);
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $context): ASTNode {
    return new ASTNode();
  }
}
