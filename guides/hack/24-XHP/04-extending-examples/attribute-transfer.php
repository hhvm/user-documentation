<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

class :ui-my-good-box extends :x:element {
  attribute :div; // inherit from attributes from <div>
  // Make sure that attributes are transferred automatically when rendering.
  use XHPHelpers;
  protected function render(): \XHPRoot {
    // returning this will transfer any attribute set on this custom object
    return
      <div class="my-good-box">{$this->getChildren()}</div>;
  }
}

function extending_examples_good_attribute_transfer_run(): void {
  $my_box = <ui-my-good-box title="My Good box" />;
  echo $my_box->toString();
}

extending_examples_good_attribute_transfer_run();
