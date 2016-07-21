<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Shuffle;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Randomize the Vector elements in place
$v->shuffle();

var_dump($v);
