<?hh // partial

class :ui-myparent extends :x:element {
  attribute string text @required;
  children (:ui-mychild);

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

class :ui-mychild extends :x:element {
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
    <ui-myparent text={$s}>
      <ui-mychild text="Go" />
    </ui-myparent>
  );
  $xhp->setContext('hint', $s);
  echo $xhp;
}
