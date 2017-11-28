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

namespace Facebook\GFM;

use namespace HH\Lib\Str;

final class FencedCodeBlock extends FencedBlock {
  public function __construct(private string $firstLine) {
    parent::__construct($firstLine);
  }

  public static function isStartedByLine(string $line): bool {
    return \preg_match(
      '/^ {0,3}(`{3,}|~{3,}) $/',
      $line,
    ) === 1;
  }

  <<__Override>>
  public function getContinuationPrefix(): ?string {
    return '';
  }

  public function isEndedByLine(string $line): bool{
    $len = Str\length($line);
    $line = Str\trim_left($line);
    if ($len - Str\length($line) > 3) {
      return false;
    }

    $start = $this->firstLine;
    if (!Str\starts_with($line, $start)) {
      return false;
    }
    return Str\trim($line, $start[0]) === '';
  }
}
