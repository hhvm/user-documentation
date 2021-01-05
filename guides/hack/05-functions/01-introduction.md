The `function` keyword defines a global function.

```add_one.hack no-auto-output
function add_one(int $x): int {
  return $x + 1;
}
```

The `function` keyword can also be used to define [methods](/hack/classes/methods).

## Default Parameters

Hack supports default values for parameters.

```add_num.hack no-auto-output
function add_value(int $x, int $y = 1): int {
  return $x + $y;
}
```

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

```varargs.hack no-auto-output
function sum_ints(int $val, int ...$vals): int {
  $result = $val;
  
  foreach ($vals as $v) {
    $result += $v;
  }
  return $result;
}
```

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

```function_type.hack no-auto-output
function apply_func(int $v, (function(int): int) $f): int {
  return $f($v);
}

function usage_example(): void {
  $x = apply_func(0, $x ==> $x + 1);
}
```

Variadic functions can also be passed as arguments.

```Hack
function takes_variadic_fun((function(int...): void) $f): void {
  $f(1, 2, 3);

  $args = vec[1, 2, 3];
  $f(0, ...$args);
}
```
