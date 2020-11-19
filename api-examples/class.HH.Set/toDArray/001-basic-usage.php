<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToDArray;

<<__EntryPoint>>
function run() {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $array = $s->toDArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
