<?hh

namespace Hack\UserDocumentation\API\Examples\Map\DifferenceByKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
    'purple' => '#663399',
  };

  $m2 = $m->differenceByKey(Set {'red', 'green', 'blue'});

  \var_dump($m2);
}
