<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

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
  echo $parent;
}

guidelines_examples_context_run('No');
echo "\n\n";
guidelines_examples_context_run('Yes');
