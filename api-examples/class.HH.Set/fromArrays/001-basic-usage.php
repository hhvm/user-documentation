<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\FromArrays;

$s = Set::fromArrays(
  varray['red'],
  varray['green', 'blue'],
  varray['yellow', 'red'], // Duplicate 'red' will be ignored
);

var_dump($s);
