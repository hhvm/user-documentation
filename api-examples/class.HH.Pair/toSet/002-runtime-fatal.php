<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Set;

<<__EntryPoint>>
function runtime_fatal_main(): void {
  $p = Pair {'foo', -1.5};

  // Fatal error will be thrown here
  $s = $p->toSet();

  \var_dump($s);
}
