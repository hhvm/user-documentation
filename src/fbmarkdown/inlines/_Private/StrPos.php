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

namespace Facebook\Markdown\Inlines\_Private\StrPos;

use namespace HH\Lib\{C, Str};

function trim_left(string $in, int $start, string $chars = " \t\n"): int {
  $len = Str\length($in);
  for ($i = $start; $i < $len; ++$i) {
    if (\strpbrk($in[$i], $chars) === false) {
      return $i;
    }
  }
  return $len;
}
