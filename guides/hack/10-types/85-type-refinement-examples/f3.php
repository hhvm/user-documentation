<?hh // strict

namespace Hack\UserDocumentation\Types\TypeRefinement\Examples\Test3;

function f3(?int $p): void {
  if (!\is_null($p)) { // type refinement occurs; $p has type int
    $x = $p % 3; // accepted; % defined for int
  }

  if ($p is nonnull) { // type refinement occurs; $p has type int
    $x = $p % 3; // accepted; % defined for int
  }
}
