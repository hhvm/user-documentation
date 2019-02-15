<?hh // strict

namespace Hack\UserDocumentation\Functions\Introduction\Examples\Distance;

<<__Entrypoint>>
function main(): void {
  $pA = create_point(3.5, -6.2);
  $pB = create_point(-2.4, 3.6);

  echo "Distance between the Points is " . distance($pA, $pB) . "\n";
}

function create_point(float $x, float $y): (float, float) {
  return tuple($x, $y);
}

function distance((float, float) $p1, (float, float) $p2): float {
  $dx = $p1[0] - $p2[0];
  $dy = $p1[1] - $p2[1];
  return \sqrt($dx*$dx + $dy*$dy);
}
