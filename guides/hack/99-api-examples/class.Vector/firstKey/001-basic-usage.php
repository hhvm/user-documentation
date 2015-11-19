<?hh

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->firstKey()); // 0

$v = Vector {};
var_dump($v->firstKey()); // NULL
