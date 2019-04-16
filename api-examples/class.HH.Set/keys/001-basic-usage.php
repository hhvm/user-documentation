<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Keys;

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s->keys());
