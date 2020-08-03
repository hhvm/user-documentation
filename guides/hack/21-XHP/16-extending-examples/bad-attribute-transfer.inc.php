<?hh // partial

xhp class ui_my_box extends :x:element {
  attribute :div; // inherit from attributes from <div>

  protected function render(): \XHPRoot {
    // returning this will ignore any attribute set on this custom object
    // They are not transferred automatically when returning the <div>
    return <div class="my-box">{$this->getChildren()}</div>;
  }
}
