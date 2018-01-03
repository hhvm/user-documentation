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

namespace Facebook\Markdown\Inlines;

use const Facebook\Markdown\_Private\ASCII_PUNCTUATION;
use namespace HH\Lib\{C, Str};

class BackslashEscape extends InlineWithPlainTextContent {

  <<__Override>>
  public static function consume(
    Context $_,
    string $string,
    int $offset,
  ): ?(Inline, int) {
    if ($string[$offset] !== "\\") {
      return null;
    }

    if ($offset === Str\length($string) - 1) {
      return null;
    }

    $next = $string[$offset + 1];
    if (C\contains_key(ASCII_PUNCTUATION, $next)) {
      return tuple(new self($next), $offset + 2);
    }

    return tuple(new self('\\'), $offset + 1);
  }
}
