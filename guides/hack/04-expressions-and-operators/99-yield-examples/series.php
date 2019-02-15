<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\Yield\Examples\Series;

function series(int $start, int $end, int $incr = 1): \Generator<int, int, void> {
  for ($i = $start; $i <= $end; $i += $incr) {
    yield $i;
  }
}

<<__Entrypoint>>
function main(): void {
  foreach (series(5, 15, 2) as $key => $val) {
    echo "key: $key, value: $val\n";
  }
  echo "-----------------\n";

  foreach (series(25, 20, 3) as $key => $val) {
    echo "key: $key, value: $val\n";
  }
  echo "-----------------\n";
}
