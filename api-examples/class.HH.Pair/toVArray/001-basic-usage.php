<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToArray;

<<__EntryPoint>>
function main(): void {
  $p = Pair {'foo', -1.5};

  $array = $p->toVArray();

  \var_dump(\is_array($array));
  \var_dump($array);
}
