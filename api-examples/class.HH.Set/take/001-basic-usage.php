<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Take;

$s = Set {'red', 'green', 'blue', 'yellow'};

// Take the first two elements
$take2 = $s->take(2);

var_dump($take2);
