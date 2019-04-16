<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Immutable;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

function expects_immutable(ImmMap<string, string> $iv): void {
  \var_dump($iv);
}

// Get a deep, immutable copy of $m
$immutable_map = $m->immutable();

expects_immutable($immutable_map);
