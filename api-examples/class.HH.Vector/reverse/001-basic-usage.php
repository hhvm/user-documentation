<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Reverse;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $v->reverse();

  \var_dump($v);
}
