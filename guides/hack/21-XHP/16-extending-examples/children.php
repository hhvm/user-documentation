<?hh // partial

class :my-br extends :x:element {
  children empty; // no children allowed

  protected function render(): \XHPRoot {
    return <x:frag>PHP_EOL</x:frag>;
  }
}

class :my-ul extends :x:element {
  children (:li)+; // one or more

  protected function render(): \XHPRoot {
    return <ul>{$this->getChildren()}</ul>;
  }
}

class :my-html extends :x:element {
  children (:head, :body);

  protected function render(): \XHPRoot {
    return <html>{$this->getChildren()}</html>;
  }
}

<<__EntryPoint>>
function extending_examples_children_run(): void {
  \__init_autoload();
  $my_br = <my-br />;
  // Even though my-br does not take any children, you can still call the
  // appendChild method with no consequences. The consequence will come when
  // you try to render the object by something like an echo.
  $my_br->appendChild(<ul />);
  try {
    echo $my_br;
  } catch (\XHPInvalidChildrenException $ex) {
    var_dump($ex->getMessage());
  }
  $my_ul = <my-ul />;
  $my_ul->appendChild(<li />);
  $my_ul->appendChild(<li />);
  echo $my_ul;
  echo PHP_EOL;
  $my_html = <my-html />;
  $my_html->appendChild(<head />);
  $my_html->appendChild(<body />);
  echo $my_html;
}
