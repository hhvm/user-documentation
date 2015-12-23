<?hh

namespace Hack\UserDocumentation\Overview\Typing\Examples\HackFunction;

function bar(int $a, int $b) {
  if ($a > 0) {
    return true;
  } else {
    return $b < 0;
  }
}

var_dump(bar(3, -1));
var_dump(bar(-1, 10));
