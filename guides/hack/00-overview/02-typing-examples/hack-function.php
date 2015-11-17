<?hh

namespace Hack\UserDocumentation\Overview\Typing\Examples\HackFunction;

function bar(int $a, string $b) {
  if ($a > 0) {
    echo '0' . $b;
  } else {
    echo (5 . $b);
  }
}

echo bar(3, 'Hello');
echo bar(-100, 'Bye');
