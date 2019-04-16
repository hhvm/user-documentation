<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\FromArrays;

$s = Set::fromArrays(
  array('red'),
  array('green', 'blue'),
  array('yellow', 'red'), // Duplicate 'red' will be ignored
);

var_dump($s);
