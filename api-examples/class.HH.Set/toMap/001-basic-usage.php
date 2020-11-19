<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToMap;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $map = $s->toMap();

  \var_dump($map is \HH\Map<_, _>);
  \var_dump($map);
}
