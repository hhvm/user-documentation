<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToVector;

$s = Set {'red', 'green', 'blue', 'yellow'};

$v = $s->toVector();

var_dump($v);
