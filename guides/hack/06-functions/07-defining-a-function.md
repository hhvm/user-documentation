A function definition defines a named function, and has the following general form:

`function` *name* `(` *parameter-list* `) :` *return-type* `{` *statements* `}`

Consider the following definition of a function that computes the distance between two Cartesian-coordinate points using Pythagoras' Theorem:

```Hack
function distance((float, float) $p1, (float, float) $p2): float {
  $dx = $p1[0] - $p2[0];
  $dy = $p1[1] - $p2[1];
  return \sqrt($dx*$dx + $dy*$dy);
}
```

The function's name is `distance`, parameters `$p1` and `$p2` have type *tuple of two `float`s*, and the return type is `float`.  The
body of the function&mdash;that is, the set of statements executed when this function is called&mdash;is enclosed in the brace pair.  A function's
body may be empty.  Each parameter is a variable local to the parent function.

A call to this function must provide two arguments, of type *tuple of two `float`s*. However, it is possible to provide fewer arguments,
provided the corresponding parameters contain default values, as follows:

```Hack
function distance(
  (float, float) $p1 = tuple(0.0, 0.0),
  (float, float) $p2 = tuple(0.0, 0.0)
  ): float {
  ...
}
```

Now, the function can be called with two arguments, the first argument only, or with no arguments, with a default value being used when
the corresponding argument is omitted.

The function returns a value using the [`return` statement](../statements/return.md).  A function having a return type of `noreturn` never
returns. Instead, it, or a function it calls directly or indirectly, terminates in some other manner, such as by throwing an exception or by
calling the non-returning library function `exit`.

Hack supports *variadic functions*; that is, functions that can be called with a variable number of arguments.  This is declared by having
an ellipsis (`...`) as the last part of a parameter list.  The parameter list components preceding that represents the fixed part while the
ellipsis represents the variable part.  For example:

@@ defining-a-function-examples/varargs.php @@

There may be more arguments than parameters.  The library functions [`func_num_args`](http://www.php.net/func_num_args),
[`func_get_arg`](http://www.php.net/func_get_arg), and [`func_get_args`](http://www.php.net/func_get_args) can be used to get access
to the complete argument list that was passed.

By default, arguments are passed by value; however, if a parameter contains the `inout` modifier, the corresponding argument must also
contain that modifier. For example:

@@ defining-a-function-examples/swap.php @@

As we can see from the output, changes to the parameters in `swap` are reflected in their corresponding arguments back in the calling function.

