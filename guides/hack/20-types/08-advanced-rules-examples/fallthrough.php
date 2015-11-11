<?hh

namespace Hack\UserDocumentation\Types\AdvancedRules\Examples\Fallthrough;

function fallthrough(int $x): void {
  switch ($x) {
    case 1: echo "1"; break; // without the break, typechecker throws an error
    case 2: echo "2"; break;
    case 3: echo "3"; break;
    case 4: echo "4";        // but we can tell the typechecker we want it
    // FALLTHROUGH
    default: echo "5";
  }
}

fallthrough(4);
