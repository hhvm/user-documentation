<?hh

namespace Hack\UserDocumentation\Operators\Pipe\Examples\MapFilterCountPiped;

function piped_example(array<int> $arr): int {
  return $arr
    |> array_map($x ==> $x * $x, $$)
    |> array_filter($$, $x ==> $x % 2 == 0)
    |> count($$);
}

var_dump(piped_example(range(1, 10)));
