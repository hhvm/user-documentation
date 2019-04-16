<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\__construct;

// Create a new string-keyed Map from an associative array
$m = new Map(array(
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
));
var_dump($m);

// Create a new integer-keyed Map from a Vector
$m = new Map(Vector {'red', 'green', 'blue', 'yellow'});
var_dump($m);
