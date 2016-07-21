<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\__construct\FromNull;

// An empty Vector is created if null is provided
$v = new Vector(null);
var_dump($v);
