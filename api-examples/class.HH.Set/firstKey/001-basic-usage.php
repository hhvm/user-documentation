<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\FirstKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->firstKey());

  $s = Set {};
  \var_dump($s->firstKey());
}
