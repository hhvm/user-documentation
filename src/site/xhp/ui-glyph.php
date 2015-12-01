<?hh // strict

final class :ui:glyph extends :x:element {
  attribute string icon;

  protected function render(): XHPRoot {
	$class = "glyphIcon fa fa-".$this->:icon;
    return <i class={$class}></i>;
  }
}
