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

namespace Facebook\GFM\BlockParsing;

use namespace HH\Lib\{C, Str, Vec};

final class BlockQuote extends ContainerBlock {
  public function __construct(
    private vec<Node> $children,
  ) {
  }

  public static function consume(vec<string> $lines): ?(Node, vec<string>) {
    $line = C\firstx($lines);
    if (\preg_match('/^ {0,3}>/', $line) !== 1) {
      return null;
    }

    // Figure out what goes in this block first
    $matched = vec[];
    for ($idx = 0; $idx < C\count($lines); ++$idx) {
      $line = $lines[$idx];
      if ($line === '') {
        break;
      }

      $matches = [];
      \preg_match('/^(?<marker> {0,3}> ?)(?<content>.*)$/', $line, $matches);
      if ($matches['marker'] ?? '' !== '') {
        $matched[] = $matches['content'];
        continue;
      }

      if (self::isParagraphContinuationText(Vec\drop($lines, $idx))) {
        $matched[] = $line;
      }
    }
    $rest = Vec\drop($lines, C\count($matched));
    return tuple(
      new self(self::consumeChildren($matched)),
      $rest,
    );
  }
}
