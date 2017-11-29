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

final class TextualContent extends Inline {
  public function __construct(
    private string $content,
  ) {
  }

  public static function consume(
    Context $context,
    string $chars,
  ): (Inline, string) {
    $out = $chars[0];
    $len = Str\length($chars);
    
    for ($i = 1; $i < $len; ++$i) {
      $rest = Str\slice($chars, $i);
      $result = self::parseWithBlacklist(
        $context,
        $rest,
        /* blacklist = */ keyset[self::class],
      );
      if ($result !== null) {
        break;
      }
      $out .= $rest[0];
    }

    return tuple(
      new self($out),
      Str\slice($chars, Str\length($out)),
    );
  }
}
