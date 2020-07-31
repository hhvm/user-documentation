<?hh // partial

class :ui-my-box extends :x:element {
  attribute :div; // inherit from attributes from <div>

  protected function render(): \XHPRoot {
    // returning this will ignore any attribute set on this custom object
    // They are not transferred automatically when returning the <div>
    return <div class="my-box">{$this->getChildren()}</div>;
  }
}

<<__EntryPoint>>
function extending_examples_bad_attribute_transfer_run(): void {
  \__init_autoload();
  $my_box = <ui-my-box title="My box" />;
  // This will only bring <div class="my-box"></div> ... title= will be
  // ignored.
  echo $my_box->toString();
}
