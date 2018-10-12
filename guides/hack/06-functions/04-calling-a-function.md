A function is called using the [function-call operator, `()`](../expressions-and-operators/function-call.md), which optionally contains a 
comma-separated list of arguments.  For example:

```Hack
$dx = 3.5;
$dy = 2.7;
$hypot = \sqrt($dx*$dx + $dy*$dy);
```

Here, we use Pythagoras’ Theorem to find the hypotenuse of a right-triangle.  The call to the library function `sqrt` contains one argument, 
of type `float`, and it returns a value of the same type.

Hack supports recursion; that is, a function can call itself directly or indirectly. For example:

@@ calling-a-function-examples/recursion.php @@

By default, arguments are passed by value; however, if a parameter contains the `inout` modifier, the corresponding argument must also 
contain that modifier. See the `swap` function in [$$](defining-a-function.md) for an example.
