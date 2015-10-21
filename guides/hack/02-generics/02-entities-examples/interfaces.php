<?hh

namespace Hack\UserDocumentation\Generics\Entities\Examples\Interfaces;

interface MyCollection<T> {
  public function put(T $item): void;
  public function get(): ?T;
}

class MyStack<T> implements MyCollection<T> {
  private Vector<T> $storage;

  public function __construct() {
    $this->storage = Vector {};
  }

  public function put(T $item): void {
    $this->storage[] = $item;
  }
  public function get(): ?T {
    // LIFO
    return $this->storage->count() > 0 ? $this->storage[0] : null;
  }
}

class MyQueue<T> implements MyCollection<T> {
  private Vector<T> $storage;

  public function __construct() {
    $this->storage = Vector {};
  }

  public function put(T $item): void {
    $this->storage[] = $item;
  }
  public function get(): ?T {
    // FIFO
    return $this->storage->count() > 0
      ? $this->storage[$this->storage->count() - 1]
      : null;
  }
}

function processCollection<T>(MyCollection<T> $p1): void {
  var_dump($p1->get());
}

function run(): void {
  $s = new MyStack();
  $s->put(5);
  $s->put(9);
  $s->put(3);
  processCollection($s);
  $q = new MyQueue();
  $q->put(5);
  $q->put(9);
  $q->put(3);
  processCollection($q);
}

run();
