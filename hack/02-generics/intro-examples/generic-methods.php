<?hh

namespace Hack\UserDocumentation\Generics\Intro\Examples\GenericMethods;

// Testing generic methods in a non-generic class.

class Box<T> {
  public T $value;
  public function __construct(T $v) {
    $this->value = $v;
  }
}

function swap<T>(Box<T> $a, Box<T> $b) : void {
  $temp = $a->value;
  $a->value = $b->value;
  $b->value = $temp;
}

function do_int_swap(): void {
  $y = new Box(3);
  $z = new Box(4);
  echo $y->value." ".$z->value;
  swap($y, $z);
  echo $y->value." ".$z->value;
}

function do_string_swap(): void {
  $y = new Box('a');
  $z = new Box('b');
  echo $y->value." ".$z->value;
  swap($y, $z);
  echo $y->value." ".$z->value;
}

function doAll(): void {
  do_int_swap();
  do_string_swap();
}

doAll();
