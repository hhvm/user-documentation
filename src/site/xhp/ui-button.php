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

use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};
use type Facebook\XHP\HTML\{a, div, span};
use type HHVM\UserDocumentation\UIGlyphIcon;

final xhp class button extends x\element {
  use XHPChild\Validation;
  attribute
    enum {'left', 'right'} align = 'left',
    string className,
    string href,
    bool inline = false,
    UIGlyphIcon glyph,
    enum {'small', 'medium', 'large'} size = 'medium',
    string target = "_self",
    enum {'default', 'confirm', 'special', 'delete'} use = 'default';

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\any_of(
      XHPChild\pcdata(),
      XHPChild\at_least_one_of(XHPChild\of_type<span>()),
    );
  }


  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $holder_class = ($this->:className !== null)
      ? "buttonHolder ".$this->:className
      : "buttonHolder";
    $button_class = "button button".
      \ucfirst($this->:use).
      " button".
      \ucfirst($this->:size);

    $glyph = null;
    $glyph_icon = $this->:glyph;
    if ($glyph_icon !== null) {
      $holder_class .= " buttonWithGlyph";
      $glyph = <glyph icon={$glyph_icon} />;
    }

    if ($this->:href !== null) {
      $button =
        <a
          class={$button_class}
          href={$this->:href}
          role="button"
          target={$this->:target}>
          {$glyph}
          <span class="buttonText">{$this->getChildren()}</span>
        </a>;
    } else {
      $button =
        <div class={$button_class} role="button">
          {$glyph}
          <span class="buttonText">{$this->getChildren()}</span>
        </div>;
    }

    if ($this->:inline) {
      $holder_class .= " buttonInlineHolder";
    }

    if ($this->:align === 'right') {
      $holder_class .= " buttonAlignRight";
    }

    return
      <div class={$holder_class}>
        {$button}
      </div>;
  }
}
