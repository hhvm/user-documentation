<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Filter;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {null, -1.5};

  $v = $p->filter($value ==> $value !== null);
  \var_dump($v);
}
