<?hh

namespace Hack\UserDocumentation\Operators\Pipe\Examples\MapFilterCountNested;

function nested_example(array<int> $arr): int {
  return count(
    array_filter(
      array_map($x ==> $x * $x, $arr),
      $x ==> $x % 2 == 0
    )
  );
}

var_dump(nested_example(range(1, 10)));
