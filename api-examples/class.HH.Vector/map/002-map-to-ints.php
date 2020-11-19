<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Map\Ints;

<<__EntryPoint>>
function map_to_ints_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $lengths = $v->map(fun('strlen'));
  \var_dump($lengths);
}
