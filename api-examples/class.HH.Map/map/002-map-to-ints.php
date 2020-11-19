<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Map\Ints;

<<__EntryPoint>>
function map_to_ints_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  $decimal_codes = $m->map(fun('hexdec'));
  \var_dump($decimal_codes);
}
