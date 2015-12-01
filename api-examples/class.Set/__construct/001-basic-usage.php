<?hh

namespace Hack\UserDocumentation\API\Examples\Set\__construct;

// Create a new Set from an array
$s = new Set(array('red', 'green', 'red', 'blue', 'blue', 'yellow'));
var_dump($s);

// Create a new Set from a Vector
$s = new Set(Vector {'red', 'green', 'red', 'blue', 'blue', 'yellow'});
var_dump($s);

// Create a new Set from the values of a Map
$s = new Set(Map {
  'red1' => 'red',
  'green' => 'green',
  'red2' => 'red',
  'blue1' => 'blue',
  'blue2' => 'blue',
  'yellow' => 'yellow',
});
var_dump($s);
