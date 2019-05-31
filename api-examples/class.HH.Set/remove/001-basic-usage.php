<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Remove;

$s = Set {'red', 'green'};

// Remove 'red' from the Set
$s->remove('red');
var_dump($s);

// Remove 'red' again (has no effect)
$s->remove('red');
var_dump($s);
