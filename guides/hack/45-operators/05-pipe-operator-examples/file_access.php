<?hh

function open_files($names, $prefix): array {
  $canonical_prefix = ucfirst(strtolower($prefix));
  return array_map($name ==>
    new SplFileInfo($canonical_prefix.$name)
      ->openFile('a'), $names);
}
