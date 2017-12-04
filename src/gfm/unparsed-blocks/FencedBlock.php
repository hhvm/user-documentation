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

namespace Facebook\GFM\UnparsedBlocks;

use namespace HH\Lib\{C, Vec};

abstract class FencedBlock extends LeafBlock {
  protected abstract static function createFromLines(vec<string> $lines): this;

  protected abstract static function getEndPatternForFirstLine(
    string $first,
  ): ?string;

  public static function consume(
    Context $_,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $first = C\firstx($lines);
    $end = static::getEndPatternForFirstLine($first);
    if ($end === null) {
      return null;
    }

    $matched = vec[$first];

    foreach (Vec\drop($lines, 1) as $line) {
      $matched[] = $line;
      if (\preg_match($end, $line) === 1) {
        break;
      }
    }

    if (C\count($matched) === 1) {
      return null;
    }

    return tuple(
      static::createFromLines($matched),
      Vec\drop($lines, C\count($matched)),
    );
  }
}
