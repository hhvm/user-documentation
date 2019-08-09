<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\Yield\Examples\Squares;

function squares(
  int $start,
  int $end,
  string $keyPrefix = "",
): \Generator<string, int, void> {
  for ($i = $start; $i <= $end; ++$i) {
    yield $keyPrefix.$i => $i * $i; // specify a key/value pair
  }
}

<<__EntryPoint>>
function main(): void {
  foreach (squares(-2, 3, "X") as $key => $val) {
    echo "key: $key, value: $val\n";
  }
}
