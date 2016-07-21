<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Map\Strings;

$s  = Set {'red', 'green', 'blue', 'yellow'};

$capitalized = $s->map(fun('strtoupper'));
var_dump($capitalized);

$shortened = $s->map($color ==> substr($color, 0, 3));
var_dump($shortened);
