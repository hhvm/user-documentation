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

final class ListItem implements Block {
  final public function __construct(
    private string $delimiter,
    private ?int $number,
    private vec<Block> $children,
  ) {
  }
}
