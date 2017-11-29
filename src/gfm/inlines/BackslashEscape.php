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

use namespace HH\Lib\{C, Str};

final class BackslashEscape extends Inline {
  // Verbatim from the GFM spec
  const keyset<string> ASCII_PUNCTUATION = keyset[
    '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.',
    '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`',
    '{', '|', '}', '~',
  ];

  const type TContent = string;

  public static function consume(
    string $string,
  ): ?(self::TNode, string) {
    if ($string[0] !== "\\") {
      return null;
    }

    invariant(
      Str\length($string) > 1,
      'should have been interpreted as hard line break',
    );

    $next = $string[1];
    if (C\contains_key(self::ASCII_PUNCTUATION, $next)) {
      return tuple(self::makeNode($next), Str\slice($string, 2));
    }

    return tuple(self::makeNode('\\'), Str\slice($string, 1));
  }
}
