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
use type Facebook\XHP\HTML\div;
use type HHVM\UserDocumentation\UIGlyphIcon;

final xhp class notice extends x\element {
  attribute
    string className,
    UIGlyphIcon glyph,
    enum {'small', 'medium', 'large'} size = 'medium',
    enum {'default', 'success', 'special', 'warning'} use = 'default';

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $holder_class = ($this->:className !== null)
      ? "noticeHolder ".$this->:className
      : "noticeHolder";
    $notice_class = "notice notice".
      \ucfirst($this->:use).
      " notice".
      \ucfirst($this->:size);

    $glyph = null;
    $glyph_icon = $this->:glyph;
    if ($glyph_icon !== null) {
      $holder_class .= " noticeWithGlyph";
      $glyph = <glyph icon={$glyph_icon} />;
    }

    return
      <div class={$holder_class}>
        <div class={$notice_class} role="note">
          {$glyph}
          {$this->getChildren()}
        </div>
      </div>;
  }
}
