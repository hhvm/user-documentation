<?hh

require __DIR__ . "/../../../../vendor/hh_autoload.php";

function xhp_object_methods_build_list(Vector<string> $names): XHPRoot {
  $list = <ul id="names" />;
  foreach ($names as $name) {
    $list->appendChild(<li>{$name}</li>);
  }
  return $list;
}

<<__EntryPoint>>
function xhp_object_methods_run(): void {
  $names = Vector {'Sara', 'Fred', 'Josh', 'Scott', 'Paul', 'David', 'Matthew'};
  $list = xhp_object_methods_build_list($names);
  foreach ($list->getChildren() as $child) {
    echo <ul>{$child}</ul> . "\n";
  }
  echo <ul>{$list->getFirstChild()}</ul> . "\n";
  echo <ul>{$list->getLastChild()}</ul>. "\n";
  foreach ($list->getAttributes() as $attr) {
    echo <ul><li>{(string) $attr}</li></ul> . "\n";
  }
  echo <ul><li>{$list->getAttribute('id')}</li></ul> . "\n";
}
