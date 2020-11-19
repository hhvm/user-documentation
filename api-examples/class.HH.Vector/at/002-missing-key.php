<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\At\MissingKey;

<<__EntryPoint>>
function missing_key_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Index 10 doesn't exist (this will throw an exception)
  \var_dump($v->at(10));
}
