<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Clear;

$s = Set {'red', 'green', 'blue', 'yellow'};
var_dump($s);

$s->clear();
var_dump($s);
