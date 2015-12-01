<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\At\ExistingKey;

$p = Pair {'foo', -1.5};

// Print the first element
var_dump($p->at(0));

// Print the second element
var_dump($p->at(1));
