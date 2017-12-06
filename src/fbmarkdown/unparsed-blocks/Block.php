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

use type Facebook\Markdown\Inlines\Context as InlineContext;
use type Facebook\Markdown\Blocks\Block as ASTBlock;
use namespace HH\Lib\Str;

abstract class Block {

  abstract public static function consume(
    Context $context,
    vec<string> $lines,
  ): ?(Block, vec<string>);

  abstract public function withParsedInlines(InlineContext $_): ASTBlock;

  protected static function isBlankLine(string $line): bool {
    return Str\trim($line, " \t") === '';
  }

  protected static function stripWhitespacePrefix(
    string $line,
    int $width,
  ): ?string {
    $count = 0;
    $len = Str\length($line);
    for ($i = 0; $i < $len && $count < $width; ++$i) {
      $char = $line[$i];
      if ($char === ' ') {
        ++$count;
        continue;
      }
      if ($char === "\t") {
        $tab_width = ($count % 4);
        if ($tab_width === 0) {
          $tab_width = 4;
        }
        $count += $tab_width;
        continue;
      }
      break;
    }
    if ($count >= $width) {
      return Str\repeat(' ', $count - $width).Str\slice($line, $i);
    }
    return null;
  }
}
