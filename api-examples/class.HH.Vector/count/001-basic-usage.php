<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Count;

$v = Vector {};
var_dump($v->count());

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->count());
