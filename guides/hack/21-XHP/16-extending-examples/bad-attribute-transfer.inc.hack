<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\BadAttributeTransfer;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\div;

final xhp class ui_my_box extends x\element {
  attribute :Facebook:XHP:HTML:div; // inherit attributes from <div>

  protected async function renderAsync(): Awaitable<x\node> {
    // returning this will ignore any attribute set on this custom object
    // They are not transferred automatically when returning the <div>
    return <div class="my-box">{$this->getChildren()}</div>;
  }
}
