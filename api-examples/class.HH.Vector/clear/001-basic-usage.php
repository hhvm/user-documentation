<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Clear;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v);

  $v->clear();
  \var_dump($v);
}
