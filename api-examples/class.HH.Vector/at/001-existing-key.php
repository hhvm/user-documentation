<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\At\ExistingKey;

<<__EntryPoint>>
function existing_key_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Print the first element
  \var_dump($v->at(0));

  // Print the last element
  \var_dump($v->at(3));
}
