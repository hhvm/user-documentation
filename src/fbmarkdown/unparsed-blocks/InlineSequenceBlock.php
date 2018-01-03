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

use type Facebook\Markdown\Blocks\InlineSequenceBlock as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\Vec;

/**  Not used by the core engine; useful for extensions when a block-level
 * extension wants to produce inlines. */
class InlineSequenceBlock extends Block {
  final public function __construct(
    private string $markdown,
  ) {
  }

  <<__Override>>
  public function withParsedInlines(
    Inlines\Context $context,
  ): ASTNode {
    return new ASTNode(
      Inlines\parse($context, $this->markdown),
    );
  }
}
