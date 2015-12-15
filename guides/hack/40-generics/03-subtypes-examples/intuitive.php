<?hh

namespace Hack\UserDocumentation\Generics\Subtypes\Examples\Intuitive;

function echo_add(num $x, num $y): void {
  echo $x + $y;
}

function get_int(): int {
  return rand();
}

function run(): void {
  $num1 = rand();
  $num2 = rand();
  echo_add($num1, $num2); // int is a subtype of num
}

run();
