<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\Reference;

function vec_ref(Vector<int> $vec): Vector<int> {
  for ($i = 0; $i < $vec->count(); $i++) {
    // Changing the vector here actually changes the vector from the calling
    // site
    $vec[$i] += 2;
  }
  return $vec;
}

function arr_value(array<int> $arr): array<int> {
  for ($i = 0; $i < \count($arr); $i++) {
    // Changing the array does not change the array at the calling site
    $arr[$i] += 2;
  }
  return $arr;
}

function run(): void {
  echo "-- VECTOR HAS REFERENCE SEMANTICS --\n\n";
  $vec = Vector {0, 1, 2, 3, 4};
  \var_dump($vec);
  vec_ref($vec);
  \var_dump($vec);
  echo "\n\n-- ARRAY HAS VALUE SEMANTICS --\n\n";
  $arr = array(0, 1, 2, 3, 4);
  \var_dump($arr);
  arr_value($arr);
  \var_dump($arr);
}

run();
