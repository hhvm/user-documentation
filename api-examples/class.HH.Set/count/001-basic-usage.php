<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Count;

$s = Set {};
var_dump($s->count());

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->count());
