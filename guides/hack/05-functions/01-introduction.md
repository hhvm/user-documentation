The `function` keyword defines a global function.

@@ introduction-examples/add_one.php @@

The `function` keyword can also be used to define [methods](/hack/classes/methods).

## Default Parameters

Hack supports default values for parameters.

@@ introduction-examples/add_num.php @@

This function can take one or two arguments. `add_value(3)` returns 4.

Required parameters must come before optional parameters, so the
following code is invalid:

```Hack
function add_value_bad(int $x = 1, int $y): int {
  return $x + $y;
}
```

## Variadic Functions

You can use `...` to define a function that takes a variable number of
arguments.

@@ introduction-examples/varargs.php @@

This function requires at least one argument, but has no maximum
number of arguments.

``` Hack
// Passing positional arguments.
sum_ints(1, 2, 3);

// You can also pass a collection into a variadic parameter.
$args = vec[1, 2, 3];
sum_ints(0, ...$args);
```

## Function Types

Functions are values in Hack, so they can be passed as arguments too.

@@ introduction-examples/function_type.php @@
