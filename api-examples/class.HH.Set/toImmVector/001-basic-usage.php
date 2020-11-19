<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToImmVector;

function expects_immutable(ImmVector<string> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Get an immutable Vector $v of the values in Set $s
  $immutable_v = $s->toImmVector();

  // Add a color to the original Set $s
  $s->add('purple');

  expects_immutable($immutable_v);
}
