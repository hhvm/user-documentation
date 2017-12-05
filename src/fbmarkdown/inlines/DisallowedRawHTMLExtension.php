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

use namespace HH\Lib\Str;

final class DisallowedRawHTMLExtension extends InlineWithPlainTextContent {
  public static function consume(
    Context $_,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    $matches = [];
    if (
      \preg_match(
        '/^<(title|textarea|style|xmp|iframe|noembed|noframes|script|'.
          'plaintext)/i',
        $string,
        $matches,
      ) !== 1
    ) {
      return null;
    }
    $tag = $matches[0];
    return tuple(
      new self($tag),
      $tag[Str\length($tag) - 1],
      Str\strip_prefix($string, $tag),
    );
  }
}
