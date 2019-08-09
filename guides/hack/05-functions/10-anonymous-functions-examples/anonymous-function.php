<?hh // strict

namespace Hack\UserDocumentation\Functions\Anonymous\Examples\Basics;

function do_it((function(int): int) $process, int $value): int {
  return $process($value);
}

<<__EntryPoint>>
function main(): void {
  $closure = function(int $p): int {
    return $p * 2;
  };
  $result = $closure(5);
  echo "\$result = $result\n";

  $result = do_it($closure, 5);
  echo "do_it returned $result\n";
  $result = do_it(
    function(int $p): int {
      return $p * $p;
    },
    5,
  );
  echo "do_it returned $result\n";

  $lambda = (int $p): int ==> $p * 2;
  $result = $lambda(5);
  echo "\$result = $result\n";

  $result = do_it($lambda, 5);
  echo "do_it returned $result\n";
  $result = do_it((int $p): int ==> $p * $p, 5);
  echo "do_it returned $result\n";
}
