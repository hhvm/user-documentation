<?hh

namespace Hack\UserDocumentation\API\Examples\Set\IsEmpty;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {};
  \var_dump($s->isEmpty());

  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->isEmpty());
}
