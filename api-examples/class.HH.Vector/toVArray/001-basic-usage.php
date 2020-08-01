<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToArray;

<<__EntryPoint>>
function main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $array = $v->toVArray();

  \var_dump(\is_array($array));
  \var_dump($array);
}
