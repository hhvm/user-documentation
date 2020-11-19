<?hh

namespace Hack\UserDocumentation\API\Examples\Set\__construct\FromNull;

<<__EntryPoint>>
function null_empty_main(): void {
  // An empty Set is created if null is provided
  $s = new Set(null);
  \var_dump($s);
}
