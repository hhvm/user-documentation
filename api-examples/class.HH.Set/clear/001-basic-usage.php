<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Clear;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  \var_dump($s);

  $s->clear();
  \var_dump($s);
}
