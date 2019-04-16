<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\AddAll;

$m = Map {};

// Add all the key-value pairs in an array
$m->addAll(array(Pair {'red', '#ff0000'}));

// Map::addAll returns the Map so it can be chained
$m->addAll(Vector {
  Pair {'green', '#00ff00'},
  Pair {'blue', '#0000ff'},
})->addall(ImmVector {
  Pair {'yellow', '#ffff00'},
  Pair {'purple', '#663399'},
});

var_dump($m);
