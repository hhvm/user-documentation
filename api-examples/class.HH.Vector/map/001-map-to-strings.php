<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Map\Strings;

$v  = Vector {'red', 'green', 'blue', 'yellow'};

$capitalized = $v->map(fun('strtoupper'));
var_dump($capitalized);

$shortened = $v->map($color ==> substr($color, 0, 3));
var_dump($shortened);
