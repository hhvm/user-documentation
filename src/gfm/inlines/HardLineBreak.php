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

final class HardLineBreak extends Inline {
  const type TContent = string;

  public static function consume(
    string $string,
  ): ?(self::TNode, string) {
    if (Str\starts_with($string, "\\\n")) {
      return tuple(self::makeNode("\\\n"), Str\slice($string, 2));
    }

    $len = Str\length($string);
    if ($len === 1 && $string === "\\") {
      return tuple(self::makeNode("\\"), '');
    }
    
    for ($i = 0; $i < $len; ++$i) {
      if ($string[$i] === ' ') {
        continue;
      }
      if ($string[$i] === "\n") {
        if ($i < 2) {
          return null;
        }

        return tuple(
          self::makeNode(Str\slice($string, 0, $i + 1)),
          Str\slice($string, $i),
        );
      }
      return null;
    }
    return null;
  }
}
