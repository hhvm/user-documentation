<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmVector;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  $immutable_v = $p->toImmVector();

  \var_dump($immutable_v);
}
