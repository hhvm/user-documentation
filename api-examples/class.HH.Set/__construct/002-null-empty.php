<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\__construct\FromNull;

// An empty Set is created if null is provided
$s = new Set(null);
var_dump($s);
