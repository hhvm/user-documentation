<?hh

namespace Hack\UserDocumentation\Tuples\RelationshipToArrays\Examples\ChgValue;

function run(): void {
  $t = tuple (3, "str", array(1, 2));
  \var_dump($t[1]); // literal syntax
  list($i, $s, $arr) = $t; // list assignment
  \var_dump($i);
  \var_dump($s);
  \var_dump($arr);
}

run();
