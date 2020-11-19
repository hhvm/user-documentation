<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToValuesArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $array = $v->toValuesArray();

  \var_dump(\HH\is_any_array($array));
  \var_dump($array);
}
