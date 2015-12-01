<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Add;

$m = Map {};

$m->add(Pair {'red', '#ff0000'});
var_dump($m);

// Map::add returns the Map so it can be chained
$m->add(Pair {'green', '#00ff00'})
  ->add(Pair {'blue', '#0000ff'})
  ->add(Pair {'yellow', '#ffff00'});
var_dump($m);
