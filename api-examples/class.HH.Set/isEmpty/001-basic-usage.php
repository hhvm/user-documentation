<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\IsEmpty;

$s = Set {};
var_dump($s->isEmpty());

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->isEmpty());
