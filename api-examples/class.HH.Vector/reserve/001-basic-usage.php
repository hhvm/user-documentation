<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Reserve;

const int VECTOR_SIZE = 1000;

$v = Vector {};
$v->reserve(VECTOR_SIZE);

for ($i = 0; $i < VECTOR_SIZE; $i++) {
  $v[] = $i * 10;
}

var_dump($v);
