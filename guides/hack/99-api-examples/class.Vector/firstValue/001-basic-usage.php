<?hh

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->firstValue()); // 'red'

$v = Vector {};
var_dump($v->firstValue()); // NULL
