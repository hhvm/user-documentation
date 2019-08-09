<?hh // strict

namespace Hack\UserDocumentation\Types\TypeRefinement\Examples\Test4;

function f4(?num $p): void {
  if (($p is int) || ($p is float)) {
    //    $x = $p**2;    // rejected
  }
}
