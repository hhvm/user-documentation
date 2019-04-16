<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToImmVector;

$s = Set {'red', 'green', 'blue', 'yellow'};

function expects_immutable(ImmVector<string> $iv): void {
  \var_dump($iv);
}

// Get an immutable Vector $v of the values in Set $s
$immutable_v = $s->toImmVector();

// Add a color to the original Set $s
$s->add('purple');

expects_immutable($immutable_v);
