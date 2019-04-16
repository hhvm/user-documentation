<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Reserve;

const int SET_SIZE = 1000;

$s = Set {};
$s->reserve(SET_SIZE);

for ($i = 0; $i < SET_SIZE; $i++) {
  $s[] = $i * 10;
}

var_dump($s);
