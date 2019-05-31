<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\FirstValue;

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->firstValue());

$s = Set {};
var_dump($s->firstValue());
