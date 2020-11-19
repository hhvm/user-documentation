<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Values;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  $immutable_v = $p->values();

  \var_dump($immutable_v);
}
