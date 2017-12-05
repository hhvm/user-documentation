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

namespace Facebook\Markdown\Blocks;

use namespace HH\Lib\Vec;

// Not used by the core engine; useful for extensions when a single piece
// of syntax might want to create multiple blocks
final class BlockSequence extends LeafBlock {
  private vec<Block> $children;

  final public function __construct(
    vec<?Block> $children,
  ) {
    $this->children = Vec\filter_nulls($children);
  }

  final public static function flatten(?Block ...$children): this {
    return new self(vec($children));
  }

  public function getChildren(): vec<Block> {
    return $this->children;
  }
}
