<?php

namespace Hack\UserDocumentation\TypeChecker\Intro\Examples\RuntimeFail;

class A {
  public function foo() { return 2; }
}

function failing($x) {
  $a = new A();
  if ($x === 4) {
    $a = null;
  }
  // $a being null would only be caught at runtime
  // Fatal error: Uncaught exception 'BadMethodCallException' with message
  // 'Call to a member function foo() on a non-object (NULL)'
  $a->foo();
}

failing(4);
