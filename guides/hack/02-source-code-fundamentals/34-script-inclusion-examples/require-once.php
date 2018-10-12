<?hh // strict
// require_once.php

namespace Hack\UserDocumentation\Fundamentals\Inclusion\Examples\Main;

require_once('Point.php');
require_once('Circle.php');

<<__Entrypoint>>
function main(): void {
  $p1 = new \Hack\UserDocumentation\Fundamentals\Inclusion\Examples\Point\Point(10, 20);
  $p2 = new \Hack\UserDocumentation\Fundamentals\Inclusion\Examples\Point\Point(5, 6);
  $c1 = new \Hack\UserDocumentation\Fundamentals\Inclusion\Examples\Circle\Circle(9, 7, 2.4);
  echo "Allocated 3 objects\n";
}
