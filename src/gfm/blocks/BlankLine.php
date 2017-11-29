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

namespace Facebook\GFM\Blocks;

use namespace HH\Lib\{C, Vec};

final class BlankLine extends LeafBlock {

  public static function consume(vec<string> $lines): ?(Node, vec<string>) {
    if (C\firstx($lines) !== '') {
      return null;
    }
    return tuple(new self(), Vec\drop($lines, 1));
  }
}
