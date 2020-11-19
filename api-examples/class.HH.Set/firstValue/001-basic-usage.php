<?hh

namespace Hack\UserDocumentation\API\Examples\Set\FirstValue;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->firstValue());

  $s = Set {};
  \var_dump($s->firstValue());
}
