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

use type Facebook\Markdown\Inlines\Context as InlineContext;
use type Facebook\Markdown\Blocks\Block as ASTBlock;
use namespace HH\Lib\{C, Str};

abstract class Block {

  abstract public static function consume(
    Context $context,
    vec<string> $lines,
  ): ?(Block, vec<string>);

  abstract public function withParsedInlines(InlineContext $_): ASTBlock;
}
