<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\FromArrays;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set::fromArrays(
    varray['red'],
    varray['green', 'blue'],
    varray['yellow', 'red'], // Duplicate 'red' will be ignored
  );

  \var_dump($s);
}
