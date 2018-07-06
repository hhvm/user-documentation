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

final class :ui:button extends :x:element {
  attribute
    enum {'left', 'right'} align = 'left',
    string className,
    string href,
    bool inline = false,
    UIGlyphIcon glyph,
    enum {'small', 'medium', 'large'} size = 'medium',
    string target = "_self",
    enum {'default', 'confirm', 'special', 'delete'} use = 'default';

  children (pcdata | :span+);

  protected function render(): XHPRoot {
    $holder_class = ($this->:className !== null)
      ? "buttonHolder ".$this->:className
      : "buttonHolder";
    $button_class =
      "button button".ucfirst($this->:use)." button".ucfirst($this->:size);

    if ($this->:href !== null) {
      $button =
        <a
          class={$button_class}
          href={$this->:href}
          role="button"
          target={$this->:target}>
          <span class="buttonText">{$this->getChildren()}</span>
        </a>;
    } else {
      $button =
        <div
          class={$button_class}
          role="button">
          <span class="buttonText">{$this->getChildren()}</span>
        </div>;
    }

    $glyph = $this->:glyph;
    if ($glyph !== null) {
      $holder_class .= " buttonWithGlyph";
      $button->prependChild(<ui:glyph icon={$glyph} />);
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
