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

final class DisallowedRawHTML extends Inline {
  public function __construct(
    private string $content,
  ) {
  }

  public static function consume(
    Context $_,
    string $string,
  ): ?(Inline, string) {
    $matches = [];
    if (
      \preg_match(
        '/^<(?<tag>title|textarea|style|xmp|iframe|noembed|noframes|script|'.
          'plaintext)/i',
        $string,
        $matches,
      ) !== 1
    ) {
      return null;
    }
    $tag = '<'.$matches['tag'];
    return tuple(
      new self($tag),
      Str\strip_prefix($string, $tag),
    );
  }
}
