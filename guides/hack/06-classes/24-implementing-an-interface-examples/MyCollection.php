<?hh // strict

namespace Hack\UserDocumentation\Classes\Interfaces\Examples\MyCollection;

interface MyCollection {
  const MAX_NUMBER_ITEMS = 1000;
  public function put(int $item): void;
  public function get(): int;
}

class MyList implements MyCollection {
  public function put(int $item): void { /* implement method */ }
  public function get(): int { /* implement method */
    return 0;
  }
  // ...
}

class MyQueue implements MyCollection {
  public function put(int $item): void { /* implement method */ }
  public function get(): int { /* implement method */
    return 0;
  }
  // ...
}

function process_collection(MyCollection $p1): void {
  /* can process any object whose class implements MyCollection */
  $p1->put(123);
}

<<__EntryPoint>>
function main(): void {
  process_collection(new MyList());
  process_collection(new MyQueue());
}
