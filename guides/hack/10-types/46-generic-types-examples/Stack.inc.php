<?hh // strict

namespace Hack\UserDocumentation\Types\Generics\Examples\Stk;

class StackUnderflowException extends \Exception {}

class Stack<T> {
  private vec<T> $stack;
  private int $stackPtr;

  public function __construct() {
    $this->stackPtr = 0;
    $this->stack = vec[];
  }

  public function push(T $value): void {
    $this->stack[] = $value;
    $this->stackPtr++;
  }

  public function pop(): T {
    if ($this->stackPtr > 0) {
      $this->stackPtr--;
      return $this->stack[$this->stackPtr];
    } else {
      throw new StackUnderflowException();
    }
  }
}
