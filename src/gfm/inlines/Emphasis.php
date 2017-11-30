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

final class Emphasis extends Inline {
  public function getContentAsPlainText(): string {
    return '';
  }

  public static function consume(
    Context $_,
    string $string,
  ): ?(Inline, string) {
    return null; // FIXME
  }
}
