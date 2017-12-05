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

use namespace HH\Lib\C;

final class ListOfItems extends Block {
  final public function __construct(
    private vec<ListItem> $items,
  ) {
  }

  public function getFirstNumber(): ?int {
    return C\firstx($this->items)->getNumber();
  }

  public function getItems(): vec<ListItem> {
    return $this->items;
  }
}
