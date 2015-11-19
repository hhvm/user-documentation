<?php

namespace Hack\UserDocumentation\Overview\Typing\Examples\PHPFunction;

function bar($a, $b) {
  if ($a > 0) {
    echo '0' . $b;
  } else {
    echo (5 . $b);
  }
}

echo bar(3, 'Hello');
echo bar(-100, 'Bye');
