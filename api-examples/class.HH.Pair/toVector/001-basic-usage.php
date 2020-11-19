<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\ToVector;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  $v = $p->toVector();
  \var_dump($v);
}
