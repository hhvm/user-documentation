Hack supports anonymous functions.

``` Hack
$f = $x ==> $x + 1;
$two = $f(1);
```

## Fat Arrow Syntax

`==>` defines an anonymous function in Hack. The following functions
are all equivalent (assuming they're used with integers):

``` Hack
$y = 10;

$f = $x ==> $x + $y;

$f = (int $x): int ==> $x + $y;

$f = $x ==> { return $x + $y; };
```

Hack can infer the types of anonymous functions in most circumstances,
but we recommend specifying types.

The `==>` operator is right-associative, and expressions can be chained together.

@@ anonymous-functions-examples/chaining.php @@

## Legacy PHP Style Syntax

Hack also supports an anonymous function syntax similar to PHP.

``` Hack
$y = 10;
$z = 20;

$f = function(int $x): int use($y, $z) { return $x + $y + $z; };

$g = function($x) { return $x + 1; };
```

This syntax requires you to specify enclosing variables that you want to
access inside the function body. This isn't necessary with the fat
arrow syntax.

Note that this syntax differs from PHP 7 anonymous lambdas, which
put `use` before the return type.

## Advanced Features

Like named functions, anonymous functions can have attributes, default argument values, and variable-argument lists, and they can be
[asynchronous](../asynchronous-operations/introduction.md).

The library functions `class_meth`, `fun`, `inst_meth`, and `meth_caller` allow a string literal containing the name of a function to be
turned into an anonymous function.

For both `__FUNCTION__` and `__METHOD__`, an anonymous function name is `{closure}`.
