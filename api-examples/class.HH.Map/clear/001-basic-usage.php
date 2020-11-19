<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Clear;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };
  \var_dump($m);

  $m->clear();
  \var_dump($m);
}
