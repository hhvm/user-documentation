<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToKeysArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $keys_array = $s->toKeysArray();

  \var_dump($keys_array === $s->toValuesArray());
  \var_dump($keys_array);
}
