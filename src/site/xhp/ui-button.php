<?hh // strict

use HHVM\UserDocumentation\UIGlyphIcon;

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

  children (pcdata);

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
          {$this->getChildren()}
        </a>;
    } else {
      $button =
        <span
          class={$button_class}
          role="button">
          {$this->getChildren()}
        </span>;
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
