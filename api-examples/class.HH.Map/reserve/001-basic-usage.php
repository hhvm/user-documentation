<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Reserve;

const int MAP_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {};
  $m->reserve(MAP_SIZE);

  for ($i = 0; $i < MAP_SIZE; $i++) {
    $m[$i] = $i * 10;
  }

  \var_dump($m);
}
