<?hh // strict

final class :ui:button extends :x:element {
  attribute
    string className,
    string href,
    bool inline = false,
    string glyph,
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
    $button =
        <span
          class={$button_class}
          role="button">
          {$this->getChildren()}
        </span>;
    if ($this->:href !== null) {
      $button =
        <a
          class={$button_class}
          href={$this->:href}
          role="button"
          target={$this->:target}>
          {$this->getChildren()}
        </a>;
    }
    if ($this->:glyph !== null) {
      $holder_class .= " buttonWithGlyph";
      $button->prependChild(
        <ui:glyph icon={$this->:glyph} />
      );
    }
    if ($this->:inline) {
      $holder_class .= " buttonInlineHolder";
    }
    return
      <div class={$holder_class}>
        {$button}
      </div>;
  }
}
