<?hh // partial

class :my_cls_adder extends :x:element {
  attribute :div;
  use XHPHelpers;
  protected function render(): \XHPRoot {
    $div = <div />;
    $div->addClass('my-cls-adder');
    $div->appendChild($this->getChildren());
    return $div;
  }
}
