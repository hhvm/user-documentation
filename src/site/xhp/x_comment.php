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

namespace HHVM\UserDocumentation;

use namespace Facebook\XHP;
use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};

final xhp class comment extends x\primitive implements XHP\AlwaysValidChild {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\any_number_of(XHPChild\pcdata());
  }

  <<__Override>>
  protected async function stringifyAsync(): Awaitable<string> {
    $html = '<!--';
    foreach ($this->getChildren() as $child) {
      $html .= \htmlspecialchars($child as string);
    }
    $html .= '-->';
    return $html;
  }
}
