<?hh // strict

use HHVM\UserDocumentation\UIGlyphIcon;

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
