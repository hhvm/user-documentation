<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\AttributeTransfer;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{div, XHPAttributeClobbering_DEPRECATED};

final xhp class ui_my_good_box extends x\element {
  attribute :Facebook:XHP:HTML:div; // inherit attributes from <div>
  attribute int extra_attr;

  protected async function renderAsync(): Awaitable<x\node> {
    // returning this will transfer any attribute set on this custom object
    return <div id="id1" {...$this} class="class1">{$this->getChildren()}</div>;
  }
}
