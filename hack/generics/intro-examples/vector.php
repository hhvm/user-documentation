<?hh
/* Signature of Vector
*
* class Vector<Tv> implements MutableCollection<Tv> {
* :
* }
*
*/

function main_vec() {
  $x = Vector {1, 2, 3, 4}; // T is associated with int
  $y = Vector {'a', 'b', 'c', 'd'}; // T is associated with string
}
