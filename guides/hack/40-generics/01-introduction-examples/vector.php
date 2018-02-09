<?hh

namespace Hack\UserDocumentation\Generics\Intro\Examples\Vec;

/* Signature of Vector
*
* class Vector<Tv> implements MutableCollection<Tv> {
* :
* }
*
*/

function main_vec(): void {
  $x = Vector {1, 2, 3, 4}; // T is associated with int
  \var_dump($x);
  $y = Vector {'a', 'b', 'c', 'd'}; // T is associated with string
  \var_dump($y);
}

main_vec();
