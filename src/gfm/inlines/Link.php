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

final class Link extends Inline {
  public function __construct(
    private string $destination,
    private vec<Inline> $text,
    private ?string $title,
  ) {
  }

  public static function consume(
    Context $_,
    string $string,
  ): ?(Inline, string) {
    return null; // FIXME
  }
}
