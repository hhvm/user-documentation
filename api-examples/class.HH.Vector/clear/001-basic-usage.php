<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Clear;

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v);

$v->clear();
var_dump($v);
