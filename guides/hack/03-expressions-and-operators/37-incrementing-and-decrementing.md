Hack provides `++` and `--` syntax for incrementing and decrementing
numbers.

The following are equivalent:

``` Hack
$i = $i + 1;
$i += 1;
$i++;
++$i;
```

Similarly for decrement:

``` Hack
$i = $i - 1;
$i -= 1;
$i--;
--$i;
```

This is typically used in for loops:

```Hack
for ($i = 1; $i <= 10; $i++) {
  // ...
}
```

Note that `++` and `--` are statements, not expressions. They cannot
be used in larger expressions.

```Hack
$x = 0;
$y = $x++; // Parse error.
```

Instead, the above code must be written as statements.

```Hack
$x = 0;
$y = $x + 1;
$x++;
```

When used as a postfix the condition is evaluated before the variable is incrimented.
A prefix works inversely.
```Hack
    $x = 0;
    echo($x++);
```
This first example results in the output `0`, while the one below results in `1`,
as the value of x is increased before it is printed.
```Hack
    $x = 0;
    echo(++$x);
```
