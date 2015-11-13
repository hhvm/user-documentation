<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

class :ui-myparent extends :x:element {
  attribute string text @required;
  children (:ui-mychild);
  protected function render(): XHPRoot {
    return
      <x:frag>{$this->:text}</x:frag>;
  }
}

class :ui-mychild extends :x:element {
  attribute string text @required;
  protected function render(): XHPRoot {
    if ($this->getContext('hint') === 'Yes') {
      return
        <x:frag>{$this->:text . '...and more'}</x:frag>;
    }
    return
      <x:frag>{$this->:text}</x:frag>;
  }
}

function guidelines_examples_context_run(string $s): void {
  $child = <ui-mychild text="Go" />;
  $parent = <ui-myparent text={$s}>{$child}</ui-myparent>;
  $parent->setContext('hint', $s);
  echo
    "There seems to be a bug here. This should work, I think. " .
    "But, the child context is not getting set via propagation.";
}

guidelines_examples_context_run('No');
guidelines_examples_context_run('Yes');
