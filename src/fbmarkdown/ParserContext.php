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

namespace Facebook\Markdown;

use type Facebook\Markdown\UnparsedBlocks\Context as BlockContext;
use type Facebook\Markdown\Inlines\Context as InlineContext;

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

  public function disableExtensions(): this {
    $this->blockContext->disableExtensions();
    $this->inlineContext->disableExtensions();
    return $this;
  }

  public function enableNamedExtension(string $name): this {
    $this->blockContext->enableNamedExtension($name);
    $this->inlineContext->enableNamedExtension($name);
    return $this;
  }

  public function setFilePath(string $file): this {
    $this->blockContext->setFilePath($file);
    return $this;
  }

  public function resetFileData(): this {
    $this->blockContext->resetFileData();
    $this->inlineContext->resetFileData();
    return $this;
  }

  public function getBlockContext(): BlockContext {
    return $this->blockContext;
  }

  public function getInlineContext(): InlineContext{
    return $this->inlineContext;
  }

  public function setBlockContext(BlockContext $ctx): this {
    $this->blockContext = $ctx;
    return $this;
  }

  public function setInlineContext(InlineContext $ctx): this {
    $this->inlineContext = $ctx;
    return $this;
  }
}
