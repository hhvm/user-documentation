<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToValuesArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $array = $s->toValuesArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
