<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\__construct;

// Create a new Vector from an array
$v = new Vector(array('red', 'green', 'blue', 'yellow'));
var_dump($v);

// Create a new Vector from a Set
$v = new Vector(Set {'red', 'green', 'blue', 'yellow'});
var_dump($v);

// Create a new Vector from the values of a Map
$v = new Vector(Map {
  'red' => 'red',
  'green' => 'green',
  'blue' => 'blue',
  'yellow' => 'yellow',
});
var_dump($v);
