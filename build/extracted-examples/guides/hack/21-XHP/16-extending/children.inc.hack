// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\Children;

// Conventionally aliased to XHPChild, which makes the children declarations
// easier to read (more fluid).
use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};
use type Facebook\XHP\HTML\{body, head, html, li, ul};

xhp class my_br extends x\primitive {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\empty();
  }

  protected async function stringifyAsync(): Awaitable<string> {
    return "\n";
  }
}

xhp class my_ul extends x\element {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\at_least_one_of(XHPChild\of_type<li>());
  }

  protected async function renderAsync(): Awaitable<x\node> {
    return <ul>{$this->getChildren()}</ul>;
  }
}

xhp class my_html extends x\element {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\sequence(
      XHPChild\of_type<head>(),
      XHPChild\of_type<body>(),
    );
  }

  protected async function renderAsync(): Awaitable<x\node> {
    return <html>{$this->getChildren()}</html>;
  }
}
