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

<<__ConsistentConstruct>>
abstract class FencedBlock extends LeafBlock {
  protected function __construct(
    vec<string> $lines,
  ) {
  }

  protected abstract static function getEndPatternForFirstLine(
    string $first,
  ): ?string;

  final public static function consume(
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

    return tuple(
      new static($matched),
      Vec\drop($lines, C\count($matched)),
    );
  }
}
