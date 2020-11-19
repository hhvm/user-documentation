<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\ToValuesArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  $array = $m->toValuesArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
