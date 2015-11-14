<?hh

$v = Vector {};

$v->add('red');
var_dump($v); // $v contains 'red'

// Vector::add returns the Vector so it can be chained
$v->add('green')->add('blue')->add('yellow');

var_dump($v); // $v contains 'red', 'green', 'blue', 'yellow'
