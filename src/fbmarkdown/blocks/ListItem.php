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

final class ListItem extends ContainerBlock {
  final public function __construct(
    private ?int $number,
    vec<Block> $children,
  ) {
    parent::__construct($children);
  }

  public function getNumber(): ?int {
    return $this->number;
  }
}
