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

use namespace HH\Lib\Str;

final class Context {
  const keyset<classname<Inline>> ALL_INLINE_TYPES = keyset[
    HardLineBreak::class,
    SoftLineBreak::class,
    CodeSpan::class,
    DisallowedRawHTML::class,
    EntityReference::class,
    Image::class,
    Link::class,
    Emphasis::class,
    Strikethrough::class,
    AutoLink::class,
    RawHTML::class,
    BackslashEscape::class,
    TextualContent::class,
  ];

  protected bool $isHtmlEnabled = false;

  public function enableHTML_UNSAFE(): this {
    $this->isHtmlEnabled = true;
    return $this;
  }

  public function getInlineTypes(): keyset<classname<Inline>> {
    $types = self::ALL_INLINE_TYPES;
    if (!$this->isHtmlEnabled) {
      unset($types[RawHTML::class]);
    }
    return $types;
  }
}
