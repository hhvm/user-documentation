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

namespace HHVM\UserDocumentation\ui;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\i;

use type HHVM\UserDocumentation\UIGlyphIcon;

final xhp class glyph extends x\element {
  attribute UIGlyphIcon icon @required;

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $class = "glyphIcon fa fa-".$this->:icon;
    return <i class={$class}></i>;
  }
}
