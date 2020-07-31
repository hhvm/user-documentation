<?hh // partial

function xhp_object_methods_build_list(Vector<string> $names): XHPRoot {
  $list = <ul id="names" />;
  foreach ($names as $name) {
    $list->appendChild(<li>{$name}</li>);
  }
  return $list;
}

<<__EntryPoint>>
function xhp_object_methods_run(): void {
  \__init_autoload();
  $names = Vector {'Sara', 'Fred', 'Josh', 'Scott', 'Paul', 'David', 'Matthew'};
  $list = xhp_object_methods_build_list($names);
  foreach ($list->getChildren() as $child) {
    /* HH_FIXME[4067] implicit __toString() is now deprecated */
    echo <ul>{$child}</ul>."\n";
  }
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo <ul>{$list->getFirstChild()}</ul>."\n";
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo <ul>{$list->getLastChild()}</ul>."\n";
  foreach ($list->getAttributes() as $attr) {
    /* HH_FIXME[4067] implicit __toString() is now deprecated */
    echo <ul><li>{(string)$attr}</li></ul>."\n";
  }
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo <ul><li>{$list->getAttribute('id') as string}</li></ul>."\n";
}
