<?hh

namespace Hack\UserDocumentation\Collections\Semantics\Examples\RefVal;

function foo(Vector<int> $vec): void {
  $vec[1] = 500;
  var_dump($vec);
}

function bar(array<int> $arr): void {
  $arr[1] = 500;
  var_dump($arr);
}

function reference_semantics(): void {
  $vec = Vector {1, 2, 3};
  var_dump($vec);
  $cp_vec = $vec;
  var_dump($cp_vec); // The two vectors are the same reference
  $vec[0] = 100; // $cp_vec is also affected by the change. They are the same.
  var_dump($vec);
  var_dump($cp_vec);
  foo($vec); // $vec will be affected by anything foo does to it.
  var_dump($vec);
}

function value_semantics(): void {
  $arr = array (1, 2, 3);
  var_dump($arr);
  $cp_arr = $arr;
  var_dump($cp_arr); // The two arrays have the same values, but are copies.
  $arr[0] = 100; // $cp_arr is not affected by this
  var_dump($arr);
  var_dump($cp_arr);
  bar($arr); // $arr is not affected by anything bar does to it
  var_dump($arr);
}

function run(): void {
  echo "--- REFERENCE SEMANTICS ---\n\n";
  reference_semantics();
  echo "\n\n--- VALUE SEMANTICS ---\n\n";
  value_semantics();
}

run();
