<?hh // partial

use namespace Facebook\XHP\ChildValidation as XHPChild;

class :ui_myparent extends :x:element {
  use XHPChildValidation;
  attribute string text @required;

  protected static function getChildrenDeclaration(): XHPChild\Constraint {
    return XHPChild\ofType<:ui_mychild>();
  }


  protected function render(): XHPRoot {
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

class :ui_mychild extends :x:element {
  attribute string text @required;

  protected function render(): XHPRoot {
    if ($this->getContext('hint') === 'Yes') {
      return <x:frag>{$this->:text.'...and more'}</x:frag>;
    }
    return <x:frag>{$this->:text}</x:frag>;
  }
}

function guidelines_examples_context_run(string $s): void {
  $xhp = (
    <ui_myparent text={$s}>
      <ui_mychild text="Go" />
    </ui_myparent>
  );
  $xhp->setContext('hint', $s);
  echo $xhp;
}
