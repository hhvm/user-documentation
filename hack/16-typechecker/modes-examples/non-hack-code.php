<?php

namespace Hack\UserDocumentation\TypeChecker\Modes\Examples\NonHack;

function php_func($x, $y) {
  return $x . $y;
}

class B {
  static function getSomeInt() {
    return 100;
  }
}
