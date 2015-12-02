<?hh // strict

use HHVM\UserDocumentation\UIGlyphIcon;

final class :ui:glyph extends :x:element {
  attribute UIGlyphIcon icon @required;

  protected function render(): XHPRoot {
    $class = "glyphIcon fa fa-".$this->:icon;
    return <i class={$class}></i>;
  }
}
