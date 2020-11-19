<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Keys;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s->keys());
}
