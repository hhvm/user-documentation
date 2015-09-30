<?hh

namespace Hack\UserDocumentation\Collections\Semantics\Examples\Converting;

function foo_with_vector(Vector<int> $vec): void {
  $vec[] = 5;
}

function foo_with_array(array<int> $arr): void {
  $arr[] = 5;
}

function run(): void {
  $arr = array (1, 2, 3);
  foo_with_array($arr);
  $arr[] = 4; // The call to foo_with_array did not affect this $arr.
  var_dump($arr);

  // Many would expect the same sequence of code to work the same
  $vec = Vector {1, 2, 3};
  foo_with_vector($vec);
  $vec[] = 4; // Uh oh, reference semantics at work. foo_with_vector affects us
  var_dump($vec);
}

run();

