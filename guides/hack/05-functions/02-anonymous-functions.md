Hack supports anonymous functions.

In the example below, the anonymous function, `$f`, evaluates to a function that
returns the value of `$x + 1`.

``` Hack
$f = $x ==> $x + 1;

$two = $f(1); // result of 2
```

## Default Functionality: Pass by Value
Anonymous functions pass _by value_, not by reference, as shown in the example below.

This is also true for any
[object property](../expressions-and-operators/member-selection) passed to an
anonymous function.

``` Hack
$x = 1;
$f = () ==> { $x = 2; }
$f();

$x; // still 1
```

Variables are scoped to the function that they're assigned in; if you need to mutate the reference, use the HSL `Ref` class.

### Closures
When working with closures, note that variables are *captured at the definition site*, not the call site:

``` Hack
$x = 1;
$f = () ==> { return $x; }
$x = 2;

$f(); // 1
```

## Type Inference

Unlike named functions, type annotations are optional on anonymous functions.
You can still add explicit types if you wish.

``` Hack
$f = (int $x): int ==> $x + 1;
```

HHVM will enforce type annotations if they are provided.

If typechecking cannot infer a type for a function, it will show an
error, and you will need to provide a type. Adding explicit type
annotations can also help the typechecker run faster.

## Fat Arrow Syntax

`==>` defines an anonymous function in Hack. An anonymous function can
be a single expression, or a block.

``` Hack
$f1 = $x ==> $x + 1;

$f2 = $x ==> { return $x + 1; };
```

## Legacy PHP-Style Syntax

Hack also supports an anonymous function syntax similar to PHP. These
are less flexible, so we recommend using fat arrow syntax.

``` Hack
$f = function($x) { return $x + 1; };
```

PHP-style lambdas require an explicit `{ ... }` block.

PHP-style lambdas also require `use` to refer to enclosing variables. Fat
arrow lambdas do not require this.

``` Hack
$y = 1;

$f = function($x) use($y) { return $x + $y; };
```

PHP-style lambdas can also specify parameter and return types.

``` Hack
$y = 1;

$f = function(int $x): int use($y) { return $x + $y; };
```

Note that this syntax is not the same as PHP 7 lambdas, which put
`use` before the return type.
