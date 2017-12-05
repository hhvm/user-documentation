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

use type Facebook\Markdown\Blocks\BlankLine as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Vec};

final class BlankLine extends LeafBlock {

  public static function consume(
    Context $_,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    if (C\firstx($lines) !== '') {
      return null;
    }
    return tuple(new self(), Vec\drop($lines, 1));
  }

  public function withParsedInlines(Inlines\Context $_ctx): ASTNode {
    return new ASTNode();
  }
}
