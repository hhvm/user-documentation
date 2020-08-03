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

use namespace Facebook\XHP\ChildValidation as XHPChild;

xhp class x:comment extends :x:primitive implements XHPAlwaysValidChild {
  use XHPChildValidation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\anyNumberOf(XHPChild\pcdata());
  }


  protected function stringify(): string {
    $html = '<!--';
    foreach ($this->getChildren() as $child) {
      $html .= htmlspecialchars($child as string);
    }
    $html .= '-->';
    return $html;
  }
}
