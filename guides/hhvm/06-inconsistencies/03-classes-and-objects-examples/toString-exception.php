<?php

namespace HHVM\UserDocumentation\Inconsistencies\Intro\Examples\toStringExc;

class A {
  public function __toString() {
    throw new \Exception('Not allowed in PHP');
    return 'A';
  }
}

$a = new A();
try {
  echo $a;
} catch (\Exception $ex) {
  echo "Exception will not be thrown to here in PHP";
}
