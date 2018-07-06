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

use type HHVM\UserDocumentation\UIGlyphIcon;

final class :ui:notice extends :x:element {
  attribute
    string className,
    UIGlyphIcon glyph,
    enum {'small', 'medium', 'large'} size = 'medium',
    enum {'default', 'success', 'special', 'warning'} use = 'default';

  protected function render(): XHPRoot {
    $holder_class = ($this->:className !== null)
      ? "noticeHolder ".$this->:className
      : "noticeHolder";
    $notice_class = 
      "notice notice".ucfirst($this->:use)." notice".ucfirst($this->:size);

    $notice =
      <div
        class={$notice_class}
        role="note">
        {$this->getChildren()}
      </div>;

    $glyph = $this->:glyph;
    if ($glyph !== null) {
      $holder_class .= " noticeWithGlyph";
      $notice->prependChild(<ui:glyph icon={$glyph} />);
    }

    return
      <div class={$holder_class}>
        {$notice}
      </div>;
  }
}
