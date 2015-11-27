<?hh

namespace Hack\UserDocumentation\API\Examples\Set\LastKey;

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->lastKey());

$s = Set {};
var_dump($s->lastKey());
