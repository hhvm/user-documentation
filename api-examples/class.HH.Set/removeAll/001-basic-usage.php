<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\RemoveAll;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $s->removeAll(Vector {
    'red',
    'blue',
    'red',
  });

  \var_dump($s);
}
