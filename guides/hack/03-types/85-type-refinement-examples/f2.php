<?hh // strict

namespace Hack\UserDocumentation\Types\TypeRefinement\Examples\Test2;

function f2(?int $p): void {
  if (\is_null($p)) {   // type refinement occurs; $p has type null
//    $x = $p % 3;      // rejected; % not defined for null
  } else {              // type refinement occurs; $p has type int
    $x = $p % 3;        // accepted; % defined for int
  }
}
