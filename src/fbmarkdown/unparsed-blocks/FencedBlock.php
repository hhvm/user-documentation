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

namespace Facebook\Markdown\UnparsedBlocks;

use namespace HH\Lib\{C, Vec};

abstract class FencedBlock extends LeafBlock {
  protected abstract static function createFromLines(
    vec<string> $lines,
    int $indentation_of_first,
    bool $eof,
  ): this;

  protected abstract static function getEndPatternForFirstLine(
    string $first,
  ): ?string;

  public static function consume(
    Context $_,
    Lines $lines,
  ): ?(this, Lines) {
    list($indentation, $first, $rest) = $lines->getColumnFirstLineAndRest();
    $end = static::getEndPatternForFirstLine($first);
    if ($end === null) {
      return null;
    }

    $matched = vec[$first];
    $eof = true;

    while (!$rest->isEmpty()) {
      list($line, $rest) = $rest->getFirstLineAndRest();
      $matched[] = $line;
      if (\preg_match($end, $line) === 1) {
        $eof = false;
        break;
      }
    }

    return tuple(
      static::createFromLines($matched, $indentation, $eof),
      $rest,
    );
  }
}
