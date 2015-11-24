<?hh

namespace Hack\UserDocumentation\API\Examples\Map\ToImmVector;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

function expects_immutable(ImmVector<string> $iv): void {
  var_dump($iv);
}

// Get an immutable Vector of $m's values
$immutable_v = $m->toImmVector();

// Add a color to the original Map $m
$m->add(Pair {'purple', '#663399'});

expects_immutable($immutable_v);
