<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToVector;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $v = $s->toVector();

  \var_dump($v);
}
