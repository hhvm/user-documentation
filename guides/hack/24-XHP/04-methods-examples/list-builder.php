<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

function xhp_object_methods_build_list(Vector<string> $names): XHPRoot {
  $list = <ul id="names" />;
  foreach ($names as $name) {
    $list->appendChild(<li>{$name}</li>);
  }
  return $list;
}

function xhp_object_methods_run(): void {
  $names = Vector {'Sara', 'Fred', 'Josh', 'Scott', 'Paul', 'David', 'Matthew'};
  $list = xhp_object_methods_build_list($names);
  foreach ($list->getChildren() as $child) {
    echo $child . "\n";
  }
  echo $list->getFirstChild() . "\n";
  echo $list->getLastChild() . "\n";
  foreach ($list->getAttributes() as $attr) {
    echo $attr . "\n";
  }
  echo $list->getAttribute('id') . "\n";
}

xhp_object_methods_run();
