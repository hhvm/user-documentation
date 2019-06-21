The `function` keyword defines a global function in Hack.

```Hack
function add_nums(int $x, int $y): int {
  return $x + $y;
}
```

This example defined a function called `add_nums`, with two parameters
`$x` and `$y`. The return type is `int`, and the body only contains
one statement in this example.

The general form is as follows:

```
async? function NAME<TYPE-PARAMETER*>( PARAMETER* ): RETURN-TYPE { STATEMENT* }
```

Note that the `function` keyword is also used to define methods inside
classes.

`async` is discussed in [asynchronous
operations](../asynchronous-operations/introduction.md) and type
parameters are discussed in [generics](../generics/introduction.md).

## Default Parameters

Hack supports default values for parameters.

```Hack
function add_nums_opt(int $x, int $y = 1): int {
  return $x + $y;
}
```

This function can take one or two arguments. `add_nums_opt(3)` has the
value 4.

Required parameters must come before optional parameters, so the
following code is invalid:

```Hack
function add_nums_bad(int $x = 1, int $y): int {
  return $x + $y;
}
```

## Variadic Functions

Hack functions can take a variable number of arguments. Variadic
functions have an ellipsis `...` on their last argument.

@@ introduction-examples/varargs.php @@

This function requires at least one argument, but has no maximum
number of arguments.

## inout Parameters

By default, arguments are passed by value; however, if a parameter contains the `inout` modifier, the corresponding argument must also
contain that modifier. For example:

@@ introduction-examples/swap.php @@

As we can see from the output, changes to the parameters in `swap` are reflected in their corresponding arguments back in the calling function.

**Topics covered in this section**

* [Calling a function](calling-a-function.md)
* [Anonymous Functions](anonymous-functions.md)
