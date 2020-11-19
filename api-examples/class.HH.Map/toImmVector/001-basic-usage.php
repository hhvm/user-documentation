<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\ToImmVector;

function expects_immutable(ImmVector<string> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Get an immutable Vector of $m's values
  $immutable_v = $m->toImmVector();

  // Add a color to the original Map $m
  $m->add(Pair {'purple', '#663399'});

  expects_immutable($immutable_v);
}
