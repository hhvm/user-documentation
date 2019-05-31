<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\IsEmpty;

$v = Vector {};
var_dump($v->isEmpty());

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->isEmpty());
