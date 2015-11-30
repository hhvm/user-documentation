<?php

namespace HHVM\UserDocumentation\Inconsistencies\Intro\Examples\DCP;

class A {}
var_dump(new A(undefined_function())); // Works in PHP5 but not HHVM

class B {
  public function __construct() {
  }
}
var_dump(new B(undefined_function())); // Doesn't work in HHVM or PHP5
