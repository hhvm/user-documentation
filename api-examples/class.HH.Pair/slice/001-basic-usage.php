<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Slice;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  // Get an ImmVector of both values
  \var_dump($p->slice(0, 2));

  // Get an ImmVector of the first value
  \var_dump($p->slice(0, 1));

  // Get an ImmVector of the second value
  \var_dump($p->slice(1, 1));
}
