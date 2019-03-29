A function is called using the [function-call operator, `()`](../expressions-and-operators/function-call.md), which optionally contains a
comma-separated list of arguments.  For example:

```Hack
$dx = 3.5;
$dy = 2.7;
$hypot = \sqrt($dx*$dx + $dy*$dy);
```

Here, we use Pythagoras' Theorem to find the hypotenuse of a right-triangle.  The call to the library function `sqrt` contains one argument,
of type `float`, and it returns a value of the same type.

Hack supports recursion; that is, a function can call itself directly or indirectly. For example:

@@ calling-a-function-examples/recursion.php @@

By default, arguments are passed by value; however, if a parameter contains the `inout` modifier, the corresponding argument must also
contain that modifier. See the `swap` function in [defining a fucntion](defining-a-function.md) for an example.

## Function calls in the presence of FormatString

The typechecker is "aware" of certain functions whose arguments are inter-related, so it can check they are called correctly. One such
function is `\printf` (and its sibling, `\sprint`). Consider the following:

```Hack
\printf("Hello, World!\n");
\printf("Value is %d\n", 6 + 4);
\printf("Decimal: %d, HEX: %X, Unsigned: %u\nBinary: %b\n", -1, -1, -1, -1);
```

from which this output is produced:

```Hack
Hello, World!
Value is 10
Decimal: -1, HEX: FFFFFFFFFFFFFFFF, Unsigned: 18446744073709551615
Binary: 1111111111111111111111111111111111111111111111111111111111111111
```

The contents of the first argument string are used to determined whether more arguments follow, and, if so, how they are to be handled.  The
expectation of further arguments and their handling are determined by the presence of *conversion specifiers*, which begin with `%`. In the
first case, there are none, so the text `Hello, World!\n` is simply written out to standard output. In the second case, `%d` is seen, so
another argument is expected, and it is output as a signed decimal integer. In the third case, `%d`, `%X`, `%u`, and `%b` are seen, so
another four arguments are expected, with their values being output as a signed decimal integer, uppercase hexadecimal integer, unsigned
decimal integer, and binary integer, respectively.

The typechecker also makes sure that the number of arguments actually provided matches the number expected. For example:

```Hack
\printf("Value is %d\n");                      // Error: too few arguments
\printf("Values are %d and %d\n", 10, 20, 30); // Error: too many arguments
```

It is important to note that the first argument **must** be a string literal:

```Hack
$format = "Value is %d\n";
\printf($format, 6 + 4); // Error: format string must be a string literal
```

In the examples above, the type of the argument passed exactly matches that expected; however, what if that was not the case? Consider the following:

```Hack
\printf("Value is %d\n", 6.0 + 4.0);     // Value is 10
\printf("Value is %d\n", 6.901 + 4.123); // Value is 11
```

The expression `6.0 + 4.0` has type `float`, yet `%d` says to format the result as a signed integer. Yes, but the runtime can then
convert `float` to `int` first. And as there are no fractional parts, no precision is lost, and 10 is output. In the case having
fractional parts, the two values are added resulting in the `float` 11.024, which is then truncated to the `int` 11.

Here are some more examples:

```Hack
\printf("Value is %d\n", false);        // Value is 0
\printf("Value is %d\n", vec[]);        // Value is 0
\printf("Value is %f\n", true);         // Value is 1.000000
\printf("Value is %f\n", vec[10,20]);   // Value is 1.000000
```

According to Hack's [conversion rules](../types/type-conversion.md), when converted to `int` (or `float`), `false` is 0 (or 0.0)
and `true` is 1 (or 1.0). And an empty `vec` is converted to 0 (or 0.0), while a non-empty one is converted to 1 (or 1.0).

But what if the argument cannot be converted to the expected form? That is flagged as an error:

```Hack
\printf("Value is %d\n", new C()); // Error: class C could not be converted to int
```

In the earlier example in which a string variable rather than a literal was given as the first argument, the actual error message
produced by the typechecker is something like the following:

```Hack
This argument must be a literal string
The function expects an object of type HH\FormatString, which is incompatible with string
```

Function `\printf` is declared, as follows:

```Hack
function printf(\HH\FormatString<PlainSprintf> $fmt, ...$fmt_args): int;
```

`FormatString` is a generic library type, and while we don't need to understand it to use `\printf`, clearly, the string literals&mdash;which
have type `string`---we've been passing as the first argument are permitted when this type is expected, but a variable of type `string` is rejected.

Examples of other functions that take an argument of this type are `invariant` and `queryf`.

