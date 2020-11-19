<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\At\MissingKey;

<<__EntryPoint>>
function missing_key_main(): void {
  $p = Pair {'foo', -1.5};

  // Index 2 doesn't exist because pairs always have exactly two elements
  \var_dump($p->at(2));
}
