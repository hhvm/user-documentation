<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\ToKeysArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  $keys_array = $m->toKeysArray();

  \var_dump(\HH\is_any_array($keys_array));
  \var_dump($keys_array);
}
