<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Filter;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {-1.5, null};

  $v = $p->filter($value ==> $value !== null);
  \var_dump($v);
}
