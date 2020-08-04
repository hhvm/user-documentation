<?hh // partial

use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};
use type Facebook\XHP\HTML\{body, head, html, li, ul};

xhp class my_br extends x\element {
  use XHPChild\Validation;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\empty();
  }

  protected async function renderAsync(): Awaitable<x\node> {
    return <x:frag>PHP_EOL</x:frag>;
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
