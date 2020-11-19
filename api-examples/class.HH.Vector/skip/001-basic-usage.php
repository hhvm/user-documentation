<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Skip;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Create a new Vector after skipping the first two elements ('red' and 'green')
  $skip2 = $v->skip(2);

  \var_dump($skip2);
}
