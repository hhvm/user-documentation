// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\RequiredAttributes;

use namespace Facebook\XHP\Core as x;

final xhp class user_info extends x\element {
  attribute int userid @required;
  attribute string name = "";

  protected async function renderAsync(): Awaitable<x\node> {
    return
      <x:frag>User with id {$this->:userid} has name {$this->:name}</x:frag>;
  }
}
