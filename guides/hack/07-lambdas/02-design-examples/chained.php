<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Design\Introduction;

function chainedLambdas(): void {
  $lambda = $x ==> $y ==> $x - $y;
  $f = $lambda(4); // You are providing $x the value 4
  echo $f(2); // You are providing $y the value 2; thus this prints 2
}

function run(): void {
  chainedLambdas();
}

run();
