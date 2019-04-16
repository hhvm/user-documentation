<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\FirstValue;

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->firstValue());

$v = Vector {};
var_dump($v->firstValue());
