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

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Vec};

class ListOfItems extends ContainerBlock {
  public function __construct(
    private bool $loose,
    vec<ListItem> $children,
  ) {
    parent::__construct($children);
  }

  public function isLoose(): bool {
    return $this->loose;
  }

  public function isTight(): bool {
    return !$this->isLoose();
  }

  public function getFirstNumber(): ?int {
    return C\firstx($this->getItems())->getNumber();
  }

  public function getItems(): vec<ListItem> {
    return Vec\map(
      $this->getChildren(),
      $child ==> TypeAssert\instance_of(ListItem::class, $child),
    );
  }
}
