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

use namespace HH\Lib\{C, Str, Vec};

function parse_blocks(string $markdown): void {
  $open_blocks = vec[new Document('')];
  $lines = Str\split($markdown, "\n");

  foreach ($lines as $line) {
    // 1.1: What blocks stay open
    $matched = vec[];
    foreach ($open_blocks as $block) {
      $prefix = $block->getContinuationPrefix();
      if ($prefix === null) {
        break;
      }
      if (!Str\starts_with($line, $prefix)) {
        break;
      }
      if (
        $block instanceof FencedCodeBlock &&
        $block->isEndedByLine($line)
      ) {
        break;
      }
      $matched[] = $block;
      $line = Str\strip_prefix($line, $prefix);
    }
    $blocks = $matched;

    $block = C\lastx($blocks);
    while ($line !== '') {
    }
  }
}
