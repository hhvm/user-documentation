<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToImmVector;

$v = Vector {'red', 'green', 'blue', 'yellow'};

function expects_immutable(ImmVector $iv): void {
  \var_dump($iv);
}

// Get a deep, immutable copy of $v
$immutable_v = $v->immutable();

// Add a color to the original Vector $v
$v->add('purple');

expects_immutable($immutable_v);
