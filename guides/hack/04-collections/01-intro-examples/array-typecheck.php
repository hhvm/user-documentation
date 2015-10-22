<?hh

namespace Hack\UserDocumentation\Collections\Intro\Examples\ArrTypeCheck;

// This is a array used like a map, but it can be passed an array used like
// a vector.
function array_as_map(array<int, int> $arr): int {
  $r = rand(0, 10); // random letter
  return array_key_exists($r, $arr) ? $arr[$r] : PHP_INT_MAX;
}

function run(): void {
  $v = array(100, 200, 300, 400);
  $v[] = 500; // index 5, value 500
  var_dump($v);
  var_dump(array_as_map($v));
}

run();

