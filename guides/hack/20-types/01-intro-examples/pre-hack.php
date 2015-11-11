<?php

namespace Hack\UserDocumentation\Types\Intro\Examples\PreHack;

class Z {}
class A {
  public $a;
  public $b;

  public function __construct($a, $b) {
    $this->a = $a;
    $this->b = $b;
  }

  public function foo($x, $y) {
    return $x * $this->a + $y * $this->b;
  }
}

function bar(A $a, $x, $y) {
  return $a->foo($x, $y);
}

function baz() {
  $a = new A(2, 4);
  $z = new Z();
  var_dump(bar($a, 9, 4));
  // Did we really want to allow passing a stringy int?
  var_dump(bar($a, 8, "3"));
  // Did we really want to allow passing booleans?
  var_dump(bar($a, true, false));
  // This will throw a fatal at runtime
  var_dump(bar($z, 1, 1));
}

baz();
