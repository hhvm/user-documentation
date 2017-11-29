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

namespace Facebook\GFM\Inlines ;

abstract class Inline {
  const keyset<classname<Inline>> INLINES = keyset[
    HardLineBreak::class,
    SoftLineBreak::class,
    TextualContent::class,
  ];
  const type TNode = (classname<Inline>, string);
  abstract public static function consume(
    string $chars,
  ): ?(self::TNode, string);

  protected static function makeNode(
    string $value,
  ): self::TNode {
    return tuple(static::class, $value);
  }
}
