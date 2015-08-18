<?hh // strict
namespace Hack\UserDocumentation\Lambdas\Examples\Design\Introduction;

function chainedLambdas(): void {
  $lambda = $x ==> $y ==> $x + $y;
  $f = $lambda(4);
  echo $f(2); // Prints 6
}
