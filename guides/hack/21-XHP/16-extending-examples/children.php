<?hh // partial

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
