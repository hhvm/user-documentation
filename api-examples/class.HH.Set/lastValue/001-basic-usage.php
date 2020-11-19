<?hh

namespace Hack\UserDocumentation\API\Examples\Set\LastValue;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->lastValue());

  $s = Set {};
  \var_dump($s->lastValue());
}
