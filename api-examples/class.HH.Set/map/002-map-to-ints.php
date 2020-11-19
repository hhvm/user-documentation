<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Map\Ints;

<<__EntryPoint>>
function map_to_ints_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $lengths = $s->map(fun('strlen'));
  \var_dump($lengths);
}
