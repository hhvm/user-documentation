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

class HardLineBreak extends Inline {
  public function __construct() {
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return "\n";
  }

  <<__Override>>
  public static function consume(
    Context $_,
    string $markdown,
    int $offset,
  ): ?(Inline, int) {
    if (Str\slice($markdown, $offset, 2) === "\\\n") {
      return tuple(new self(), $offset + 2);
    }

    $len = Str\length($markdown);
    for ($i = $offset; $i < $len; ++$i) {
      if ($markdown[$i] === ' ') {
        continue;
      }
      if ($markdown[$i] === "\n") {
        if ($i - $offset < 2) {
          return null;
        }

        return tuple(new self(), $i + 1);
      }
      return null;
    }
    return null;
  }
}
