<?hh

namespace Hack\UserDocumentation\XHP\Intro\Examples\ATV;

require __DIR__ . "/../../../../vendor/autoload.php";

function using_string(): void {
  echo '<ul><i>Item 1</i></ul>';
}

function using_xhp(): void {
  try {
    echo <ul><i>Item 1</i></ul>;
  } catch (\XHPInvalidChildrenException $ex) {
    // We will get here because an <i> cannot be nested directly below a <ul>
    var_dump($ex->getMessage());
  }
}

function run(): void {
  using_string();
  echo PHP_EOL . PHP_EOL;
  using_xhp();
}

run();
