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

class TaskListItemExtension extends ListItem {
  public function __construct(
    private bool $checked,
    ?int $number,
    vec<Block> $children,
  ) {
    parent::__construct($number, $children);
  }

  final public function isChecked(): bool {
    return $this->checked;
  }
}
