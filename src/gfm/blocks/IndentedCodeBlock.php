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

use namespace HH\Lib\{C, Str, Vec};

final class IndentedCodeBlock extends LeafBlock {
  public function __construct(vec<string> $lines) {
  }

  public static function consume(vec<string> $lines): ?(Node, vec<string>) {
    $matched = vec[];
    foreach ($lines as $line) {
      if (Str\starts_with($line, '    ')) {
        $matched[] = $line;
      } else {
        break;
      }
    }

    if (C\count($matched) === 0) {
      return null;
    }

    return tuple(
      new self($matched),
      Vec\drop($lines, C\count($matched)),
    );
  }
}
