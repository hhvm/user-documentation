<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Values;

$s = Set {'red', 'green', 'blue', 'yellow'};

$v = $s->values();

var_dump($v);
