<?php

namespace Hack\UserDocumentation\Overview\Typing\Examples\PHPFunction;

function bar($a, $b) {
  if ($a > 0) {
    return true;
  } else {
    return $b < 0;
  }
}

var_dump(bar(3, -1));
var_dump(bar(-1, 10));
