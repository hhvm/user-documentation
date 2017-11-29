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

final class ListOfItems extends ContainerBlock {
  public function __construct(
    private vec<Node> $children,
  ) {
  }

  public static function consume(vec<string> $lines): ?(Node, vec<string>) {
    $first = ListItem::consume($lines);
    if ($first === null) {
      return null;
    }
    list($first, $lines) = $first;
    $nodes = vec[$first];
    $d = $first->getDelimiter();

    while (!C\is_empty($lines)) {
      $next = ListItem::consume($lines);
      if ($next === null) {
        break;
      }
      list($next, $rest) = $next;
      if ($next->getDelimiter() !== $d) {
        break;
      }
      $nodes[] = $next;
      $lines = $rest;
    }

    return tuple(new self($nodes), $lines);
  }
}
