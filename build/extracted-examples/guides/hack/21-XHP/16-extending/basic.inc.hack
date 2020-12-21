// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\Basic;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\strong;

final xhp class introduction extends x\element {
  protected async function renderAsync(): Awaitable<x\node> {
    return <strong>Hello!</strong>;
  }
}

final xhp class intro_plain_str extends x\primitive {
  protected async function stringifyAsync(): Awaitable<string> {
    return 'Hello!';
  }
}
