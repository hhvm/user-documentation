<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Take;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Take the first two elements
  $take2 = $v->take(2);

  \var_dump($take2);
}
