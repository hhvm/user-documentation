<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\Categories;

use namespace Facebook\XHP\{
  ChildValidation as XHPChild,
  Core as x,
  HTML\Category,
};

xhp class my_text extends x\element implements Category\Phrase {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\any_of(
      XHPChild\pcdata(),
      XHPChild\of_type<Category\Phrase>(),
    );
  }

  protected async function renderAsync(): Awaitable<x\node> {
    return <x:frag>{$this->getChildrenOfType<Category\Phrase>()}</x:frag>;
  }
}
