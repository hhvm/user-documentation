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

final class Document extends ContainerBlock {
  public function __construct(
    private vec<Node> $children,
  ) {
  }

  public static function consume(vec<string> $lines): (Node, vec<string>) {
    return tuple(
      new self(self::consumeChildren($lines)),
      vec[],
    );
  }
}
