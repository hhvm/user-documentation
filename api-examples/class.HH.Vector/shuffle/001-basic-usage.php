<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Shuffle;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Randomize the Vector elements in place
  $v->shuffle();

  \var_dump($v);
}
