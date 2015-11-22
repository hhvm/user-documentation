<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Immutable;

$v = Vector {'red', 'green', 'blue', 'yellow'};

function expects_immutable(\HH\ImmVector $iv): void {
  var_dump($iv);
}

// Get a deep, immutable copy of $v
$immutable_v = $v->immutable();

expects_immutable($immutable_v);
