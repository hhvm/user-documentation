<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Get;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Index 0 is the element 'red'
var_dump($v->get(0));

// Index 10 doesn't exist
var_dump($v->get(10));
