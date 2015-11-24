<?hh

namespace Hack\UserDocumentation\API\Examples\Map\__construct\FromNull;

// An empty Map is created if null is provided
$m = new Map(null);
var_dump($m);
