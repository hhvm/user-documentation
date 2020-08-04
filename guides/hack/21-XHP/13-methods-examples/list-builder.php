<?hh // partial

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{li, ul};

function xhp_object_methods_build_list(Vector<string> $names): x\node {
  $list = <ul id="names" />;
  foreach ($names as $name) {
    $list->appendChild(<li>{$name}</li>);
  }
  return $list;
}

<<__EntryPoint>>
async function xhp_object_methods_run(): Awaitable<void> {
  \init_docs_autoloader();
  $names = Vector {'Sara', 'Fred', 'Josh', 'Scott', 'Paul', 'David', 'Matthew'};

  $list = xhp_object_methods_build_list($names);
  foreach ($list->getChildren() as $child) {
    $xhp = <ul>{$child}</ul>;
    echo await $xhp->toStringAsync()."\n";
  }

  $list = xhp_object_methods_build_list($names);
  $xhp = <ul>{$list->getFirstChild()}</ul>;
  echo await $xhp->toStringAsync()."\n";

  $list = xhp_object_methods_build_list($names);
  $xhp = <ul>{$list->getLastChild()}</ul>;
  echo await $xhp->toStringAsync()."\n";

  foreach ($list->getAttributes() as $attr) {
    $xhp = <ul><li>{(string)$attr}</li></ul>;
    echo await $xhp->toStringAsync()."\n";
  }

  $xhp = <ul><li>{$list->getAttribute('id') as string}</li></ul>;
  echo await $xhp->toStringAsync()."\n";
}
