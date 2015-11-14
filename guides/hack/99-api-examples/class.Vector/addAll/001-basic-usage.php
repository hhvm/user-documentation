<?hh

$v = Vector {};

// Add all the values in a Set
$v->addAll(Set {'a', 'b'});

// Add all the values in a Vector
$v->addAll(Vector {'c', 'd'});

// Add all the values in a Map
$v->addAll(Map {'foo' => 'e', 'bar' => 'f'});

// Add all the values in an array
$v->addAll(array('g', 'h'));

// Vector::addAll returns the Vector so it can be chained
$v->addAll(ImmSet {'i', 'j'})
  ->addAll(ImmVector {'k', 'l'});

var_dump($v); // $v contains 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'