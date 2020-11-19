<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToSet;

<<__EntryPoint>>
function basic_usage_main(): void {
  // This Vector contains repetitions of 'red' and 'blue'
  $v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

  $set = $v->toSet();

  \var_dump($set is \HH\Set<_>);
  \var_dump($set);
}
