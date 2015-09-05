<?hh // decl

// Before this was <?php code. Now the typechecker can see the signatures of
// these functions and classes for when Hack calls them, even in strict mode.

namespace Hack\UserDocumentation\TypeChecker\Modes\Examples\Decl;

function php_func($x, $y) {
  return $x . $y;
}

class B {
  static function getSomeInt() {
    return 100;
  }
}
