<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\__construct\FromNull;

<<__EntryPoint>>
function null_empty_main(): void {
  // An empty Vector is created if null is provided
  $v = new Vector(null);
  \var_dump($v);
}
