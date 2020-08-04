<?hh // partial

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{div, XHPAttributeClobbering_DEPRECATED};

final xhp class ui_my_good_box extends x\element {
  attribute :Facebook:XHP:HTML:div; // inherit attributes from <div>
  // Make sure that attributes are transferred automatically when rendering.
  use XHPAttributeClobbering_DEPRECATED;

  protected async function renderAsync(): Awaitable<x\node> {
    // returning this will transfer any attribute set on this custom object
    return <div class="my-good-box">{$this->getChildren()}</div>;
  }
}
