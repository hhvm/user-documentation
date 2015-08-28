<?hh
namespace Hack\UserDocumentation\Lambdas\Examples\Design\Introduction;

function evenNumbers(): Vector<int> {
  $numbers = Vector { 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 };
  return $numbers->filter($n ==> $n % 2 == 0);
}

var_dump(evenNumbers());
