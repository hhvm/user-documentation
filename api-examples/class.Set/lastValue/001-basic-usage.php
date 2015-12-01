<?hh

namespace Hack\UserDocumentation\API\Examples\Set\LastValue;

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->lastValue());

$s = Set {};
var_dump($s->lastValue());
