<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\SkipWhile;

$s = Set {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

// Skip values until we reach one over 10
$s2 = $s->skipWhile($x ==> $x <= 10);
var_dump($s2);
