<?php

namespace HHVM\UserDocumentation\Inconsistencies\Intro\Examples\Call;

class B {
}
class G extends B {
  function __call($name, $arguments) { var_dump('G');}
  function f4missing($a) {
    B::f4missing(5); // __call checking happened at B
  }
}
$g = new G();
$g->f4missing(3);
