<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Count;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {};
  \var_dump($s->count());

  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->count());
}
