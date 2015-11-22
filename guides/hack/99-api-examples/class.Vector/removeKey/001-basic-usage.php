<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\RemoveKey;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Remove 'blue' at index 2
$v->removeKey(2);
var_dump($v);

// Remove 'red' and then remove 'green'
$v->removeKey(0)->removeKey(0);
var_dump($v);
