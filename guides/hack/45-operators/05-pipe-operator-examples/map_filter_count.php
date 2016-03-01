<?hh

function pipe_operator_example1($arr): int {
  return count(array_filter(
    array_map($x ==> $x->getNumber(), $arr),
      $x ==> $x % 2 == 0));
}
