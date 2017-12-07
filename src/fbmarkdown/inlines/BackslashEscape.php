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

use namespace HH\Lib\{C, Str};

final class BackslashEscape extends InlineWithPlainTextContent {
  // Verbatim from the GFM spec
  const keyset<string> ASCII_PUNCTUATION = keyset[
    '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.',
    '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`',
    '{', '|', '}', '~',
  ];

  public static function consume(
    Context $_,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    if ($string[0] !== "\\") {
      return null;
    }

    if (Str\length($string) === 1) {
      return null;
    }

    $next = $string[1];
    if (C\contains_key(self::ASCII_PUNCTUATION, $next)) {
      return tuple(new self($next), "\n", Str\slice($string, 2));
    }

    return tuple(new self('\\'), "\n", Str\slice($string, 1));
  }
}
