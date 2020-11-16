<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\GetId;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{span, XHPHTMLHelpers};

xhp class my_id extends x\element {
  attribute string id;
  use XHPHTMLHelpers;
  protected async function renderAsync(): Awaitable<x\node> {
    return <span id={$this->getID()}>This has a random id</span>;
  }
}
