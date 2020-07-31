<?hh // partial

function intro_examples_allowed_tag_validation_using_string(): void {
  echo '<ul><i>Item 1</i></ul>';
}

function intro_examples_allowed_tag_validation_using_xhp(): void {
  try {
    echo <ul><i>Item 1</i></ul>;
  } catch (\XHPInvalidChildrenException $ex) {
    // We will get here because an <i> cannot be nested directly below a <ul>
    var_dump($ex->getMessage());
  }
}

<<__EntryPoint>>
function intro_examples_allowed_tag_validation_run(): void {
  \__init_autoload();
  intro_examples_allowed_tag_validation_using_string();
  echo PHP_EOL.PHP_EOL;
  intro_examples_allowed_tag_validation_using_xhp();
}
