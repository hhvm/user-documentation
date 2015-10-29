<?php

namespace HHVM\UserDocumentation\Configuration\Examples\Examples\Force;

function foo (int $a): int {
  if ($a === 3) {
    return 1;
  }
  return -1;
}

var_dump(foo(3) + 4);
