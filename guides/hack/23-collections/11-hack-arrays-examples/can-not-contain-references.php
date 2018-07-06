<?hh

namespace Hack\UserDocumentation\Collections\HackArrays\Examples\CanNotContainReferences;

function foo(int &$foo) {
  $foo = 346;
}

$y = vec[1,2,3];
foo(&$y[2]);
var_dump($y);
