<?hh

namespace Hack\UserDocumentation\Attributes\Special\Examples\Memoize;

function takes_a_long_time(): int {
  \sleep(3); // fake something that takes a while
  return 5;
}

class A {
  <<__Memoize>>
  public function bar(): int {
    return takes_a_long_time();
  }
}

function test_memoize(): void {
  $a = new A();
  $start = \microtime(true);
  $x = $a->bar();
  $end = \microtime(true);
  \var_dump($x);
  echo "Total time taken (pre-memoize): " . \strval($end - $start) .
       " seconds" . \PHP_EOL; // Around 3 seconds
  $start = \microtime(true);
  $x = $a->bar();
  $end = \microtime(true);
  \var_dump($x);
  echo "Total time taken (post-memoize): " . \strval($end - $start) .
       " seconds" . \PHP_EOL; // <<< 1 second
}

test_memoize();
