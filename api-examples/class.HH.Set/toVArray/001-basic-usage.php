<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToVArray;

<<__EntryPoint>>
function run() {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $array = $s->toVArray();

  \var_dump(\is_array($array));
  \var_dump($array);
}
