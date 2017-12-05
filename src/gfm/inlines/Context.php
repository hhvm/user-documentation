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

namespace Facebook\GFM\Inlines;

use type Facebook\GFM\UnparsedBlocks\Context as BlockContext;
use namespace HH\Lib\{Keyset, Str};

class Context {
  const keyset<classname<Inline>> ALL_INLINE_TYPES = keyset[
    AutoLink::class,
    AutoLinkExtension::class,
    Link::class,
    HardLineBreak::class,
    SoftLineBreak::class,
    CodeSpan::class,
    DisallowedRawHTMLExtension::class,
    EntityReference::class,
    Image::class,
    Emphasis::class,
    StrikethroughExtension::class,
    RawHTML::class,
    BackslashEscape::class,
    TextualContent::class,
  ];

  protected bool $isHtmlEnabled = false;

  public function enableHTML_UNSAFE(): this {
    $this->isHtmlEnabled = true;
    return $this;
  }

  public function isHTMLEnabled(): bool {
    return $this->isHtmlEnabled;
  }

  public function getFilePath(): ?string {
    return $this->getBlockContext()->getFilePath();
  }

  private ?BlockContext $blockContext;

  public function setBlockContext(BlockContext $ctx): this {
    $this->blockContext = $ctx;
    return $this;
  }

  public function getBlockContext(): BlockContext {
    $ctx = $this->blockContext;
    invariant(
      $ctx !== null,
      'Call %s::setBlockContext before parsing inlines',
      static::class,
    );
    return $ctx;
  }

  public function resetFileData(): this {
    $this->blockContext = null;
    return $this;
  }

  private keyset<classname<Inline>> $inlineTypes = self::ALL_INLINE_TYPES;

  public function getInlineTypes(): keyset<classname<Inline>> {
    return $this->inlineTypes;
  }

  public function prependInlineTypes(classname<Inline> ...$types): this {
    $this->inlineTypes = Keyset\union($types, $this->inlineTypes);
    return $this;
  }
}
