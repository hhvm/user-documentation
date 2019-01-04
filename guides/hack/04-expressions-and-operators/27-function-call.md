A function is called using the `()` operator, which optionally contains a comma-separated list of expressions called *arguments*.  Consider 
the following function definition and call:

@@ function-call-examples/distance-between-Points.php @@

Here, the function `distance` is called from `main` using the called-function's name followed by the function-call operator containing a 
list of two arguments.  Each argument corresponds by position to a parameter in the called function's definition. An argument can have any 
type that is compatible with the corresponding parameter. In a function call, the arguments are evaluated in the order left-to-right.  This 
is important to understand if any of the argument values contains [side-effects](some-basics.md); for example:

```Hack
distance(tuple($v++, -6.2), tuple(-$v, 3.6))
```

Ordinarily, the function-call operator is preceded by the name of the function to be called; however, what that operator really needs is an 
expression that designates a function, and alternative approaches are available beside using that function's name. Consider the following example, 
which indexes into an array of anonymous-function objects, and calls the resulting unnamed function:

@@ function-call-examples/array-of-closures.php @@

In the function call, 

```Hack
$table[$i++]($i)
```

the expression designating the function is evaluated before the expressions in the argument list, so given that `$i` has value 0, the call is

```Hack
$table[0](1)
```

which calls the doubler function, which returns 1x2=2.

In the second call, 

```Hack
$table[$i](++$i)
```

given that `$i` has value 1, the call is

```Hack
$table[1](2)
```

which calls the times-5 function and results in 2x5=10.

When a function is called, the value of each argument passed to it is assigned to the corresponding parameter in that function's definition, 
if such a parameter exists.  Any parameter having a default value, but no corresponding argument, takes on that default value.  For example:

```Hack
function f3(int $p1 = -1, float $p2 = 99.99, string $p3 = '??'): void { ... }
f3();                   // $p1 is -1, $p2 is 99.99, $p3 is ??
f3(123);                // $p1 is 123, $p2 is 99.99, $p3 is ??
f3(123, 3.14);          // $p1 is 123, $p2 is 3.14, $p3 is ??
f3(123, 3.14, 'Hello'); // $p1 is 123, $p2 is 3.14, $p3 is Hello
```

If the called function is variadic, the function call can have any number of arguments, provided the function call has at least an argument 
for each parameter not having a default value.  When an argument corresponds to the ellipsis in the called function's definition, the argument 
can have any type.

Direct and indirect recursive function calls are permitted.  For example:

```Hack
function factorial(int $i): int {
  if ($i > 1) return $i * factorial($i - 1);
  else if ($i === 1) return $i;
  else return 0;
}
```

When an instance method or constructor is called, the instance used becomes the value of `$this` in the invoked method or constructor. However, 
if no instance was used (for example, in the call `C::instance_method()`) the invoked instance has no `$this` defined.

By default, arguments are passed by value; however, if a parameter contains the `inout` modifier, the corresponding argument must also contain 
that modifier. See the `swap` function in [$$](../functions/defining-a-function.md) for an example.
