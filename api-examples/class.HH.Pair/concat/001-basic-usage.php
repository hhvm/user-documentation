<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Concat;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  $v = $p->concat(varray[100, 'bar']);
  \var_dump($v);
}
