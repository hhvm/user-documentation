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

use namespace HH\Lib\C;

final class Document extends ContainerBlock {
  public function __construct(private vec<Node> $children) {
  }
  public static function consume(vec<string> $lines): (Node, vec<string>) {
    $children = vec[];
    while (!C\is_empty($lines)) {
      $match = null;
      foreach (Block::PRIORITIZED_BLOCK_TYPES as $block) {
        $match = $block::consume($lines);
        if ($match !== null) {
          break;
        }
      }
      invariant($match !== null, 'should *always* find a match');
      list($child, $new_lines) = $match;
      $children[] = $child;
      invariant(
        C\count($lines) > C\count($new_lines),
        'consuming failed to reduce line count',
      );
      $lines = $new_lines;
    }
    return tuple(new self($children), vec[]);
  }
}
