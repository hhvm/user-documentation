<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToArray;

<<__EntryPoint>>
function main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $array = $v->toVArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
