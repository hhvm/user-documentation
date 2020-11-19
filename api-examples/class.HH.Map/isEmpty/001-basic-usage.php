<?hh

namespace Hack\UserDocumentation\API\Examples\Map\IsEmpty;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {};
  \var_dump($m->isEmpty());

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
    'purple' => '#663399',
  };
  \var_dump($m->isEmpty());
}
