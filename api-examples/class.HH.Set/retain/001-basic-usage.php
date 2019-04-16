<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Retain;

$s = Set {'red', 'green', 'blue', 'yellow'};

// Only keep values beginning with 'r' or 'b'
$s->retain($color ==> $color[0] === 'r' || $color[0] === 'b');
var_dump($s);
