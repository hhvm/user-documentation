<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\LastKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->lastKey());

  $s = Set {};
  \var_dump($s->lastKey());
}
