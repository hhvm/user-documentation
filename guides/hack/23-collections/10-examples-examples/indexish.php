<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\IndexishIface;

// Since this returns Indexish, we can return both a Vector and Map from this
// function. Could also return a Pair too (not a Set since you don't access a
// Set by key).
function return_indexish(bool $which): \Indexish<int, mixed> {
  return $which ? Vector {100, 200, 300} : Map {0 => 'A', 1 => 'B', 2 => 'C'};
}

function run(): void {
  var_dump(return_indexish(true));
  var_dump(return_indexish(false));
}

run();
