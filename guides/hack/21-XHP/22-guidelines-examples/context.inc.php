<?hh // partial

use namespace Facebook\XHP\{ChildValidation as XHPChild, Core as x};
use type Facebook\XHP\HTML\{dd, dl, dt};

final xhp class ui_myparent extends x\element {
  use XHPChild\Validation;
  attribute string text @required;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\of_type<ui_mychild>();
  }

  protected async function renderAsync(): Awaitable<x\node> {
    return (
      <dl>
        <dt>Text</dt>
        <dd>{$this->:text}</dd>
        <dt>Child</dt>
        <dd>{$this->getChildren()}</dd>
      </dl>
    );
  }
}

final xhp class ui_mychild extends x\element {
  attribute string text @required;

  protected async function renderAsync(): Awaitable<x\node> {
    if ($this->getContext('hint') === 'Yes') {
      return <x:frag>{$this->:text.'...and more'}</x:frag>;
    }
    return <x:frag>{$this->:text}</x:frag>;
  }
}

async function guidelines_examples_context_run(string $s): Awaitable<void> {
  $xhp = (
    <ui_myparent text={$s}>
      <ui_mychild text="Go" />
    </ui_myparent>
  );
  $xhp->setContext('hint', $s);
  echo await $xhp->toStringAsync();
}
