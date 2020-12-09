Certain types (classes, interfaces, and traits) and their methods can be *parameterized*; that is, their declarations can have one or more
placeholder names&mdash;called *type parameters*---that are associated with types via *type arguments* when a class is instantiated, or a method
is called. A type or method having such placeholder names is called a *generic type* or *generic method*, respectively. Top-level functions
can also be parameterized giving rise to *generic functions*.

Generics allow programmers to write a class or method with the ability to be parameterized to any set of types, all while preserving type safety.

Consider the following example in which `Stack` is a generic class having one type parameter, `T`:

```Stack.inc.hack no-auto-output
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
```

As shown, the type parameter `T` is used in the declaration of the instance property `$stack`, as the parameter type of the instance method
`push`, and as the return type of the instance method `pop`. Note that although `push` and `pop` use the type parameter, they are not themselves
generic methods.

```Stack.test.hack no-auto-output
function useIntStack(Stack<int> $stInt): void {
  $stInt->push(10);
  $stInt->push(20);
  $stInt->push(30);
  echo 'pop => '.$stInt->pop()."\n";
  //  $stInt->push(10.5); // rejected as not being type-safe
}
```

The line commented-out, attempts to call push with a non-`int` argument. This is rejected, because `$stInt` is a stack of `int`.

The *arity* of a generic type or method is the number of type parameters declared for that type or method. As such, class `Stack` has arity 1.

Here is an example of a generic function, `swap`, having one type parameter, `T`:

```swap.hack
function swap<T>(inout T $i1, inout T $i2): void {
  $temp = $i1;
  $i1 = $i2;
  $i2 = $temp;
}

<<__EntryPoint>>
function main(): void {
  $v1 = -10;
  $v2 = 123;
  echo "\$v1 = ".$v1.", \$v2 = ".$v2."\n";
  swap(inout $v1, inout $v2);
  echo "\$v1 = ".$v1.", \$v2 = ".$v2."\n";

  $v3 = "red";
  $v4 = "purple";
  echo "\$v3 = ".$v3.", \$v4 = ".$v4."\n";
  swap(inout $v3, inout $v4);
  echo "\$v3 = ".$v3.", \$v4 = ".$v4."\n";
}
```

The function swaps the two arguments passed to it. In the case of the call with two `int` arguments, `int` is inferred as
the type corresponding to the type parameter `T`. In the case of the call with two `string` arguments,
`string` is inferred as the type corresponding to the type parameter `T`.

Type parameters are discussed further in [type
parameters](type-parameters.md).
