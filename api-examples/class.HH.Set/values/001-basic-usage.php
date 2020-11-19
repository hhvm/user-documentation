<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Values;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $v = $s->values();

  \var_dump($v);
}
