<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Keys;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v->keys());
}
