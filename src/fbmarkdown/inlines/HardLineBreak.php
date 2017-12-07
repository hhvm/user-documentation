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

final class HardLineBreak extends Inline {
  public function __construct() {
  }

  public function getContentAsPlainText(): string {
    return "\n";
  }

  public static function consume(
    Context $_,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    if (Str\starts_with($string, "\\\n")) {
      return tuple(new self(), "\n", Str\slice($string, 2));
    }

    $len = Str\length($string);
    for ($i = 0; $i < $len; ++$i) {
      if ($string[$i] === ' ') {
        continue;
      }
      if ($string[$i] === "\n") {
        if ($i < 2) {
          return null;
        }

        return tuple(new self(), $string[$i], Str\slice($string, $i));
      }
      return null;
    }
    return null;
  }
}
