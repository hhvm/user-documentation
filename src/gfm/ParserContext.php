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

namespace Facebook\GFM;

use type Facebook\GFM\UnparsedBlocks\Context as BlockContext;
use type Facebook\GFM\Inlines\Context as InlineContext;

final class ParserContext {
  private BlockContext $blockContext;
  private InlineContext $inlineContext;

  public function __construct() {
    $this->blockContext = new BlockContext();
    $this->inlineContext = new InlineContext();
  }

  public function enableHTML_UNSAFE(): this {
    $this->blockContext->enableHTML_UNSAFE();
    $this->inlineContext->enableHTML_UNSAFE();
    return $this;
  }

  public function getBlockContext(): BlockContext {
    return $this->blockContext;
  }

  public function getInlineContext(): InlineContext{
    return $this->inlineContext;
  }
}
