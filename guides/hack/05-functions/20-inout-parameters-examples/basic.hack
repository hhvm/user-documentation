function takes_inout(int $a, inout int $b): void {
  ++$a;
  ++$b;
}

<<__EntryPoint>>
function inout_test(): void {
  $x = 0;
  $y = 0;

  takes_inout($x, inout $y);

  echo "x = $x\n";
  echo "y = $y\n";
}
