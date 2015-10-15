<?hh

namespace Hack\UserDocumentation\TypeAliases\Transparent\Examples\Converted;

type transparent = int;

function create_transparent(int $x): transparent {
  return $x; // implicit conversion from int to transparent
}

function take_int(int $x): int {
  return $x + 3;
}

function run(): void {
  $t = create_transparent(10);
  var_dump($t);
  var_dump(take_int($t)); // implicit conversion from transparent to int
}

run();
