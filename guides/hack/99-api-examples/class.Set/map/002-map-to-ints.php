<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Map\Ints;

$s  = Set {'red', 'green', 'blue', 'yellow'};

$lengths = $s->map(fun('strlen'));
var_dump($lengths);
