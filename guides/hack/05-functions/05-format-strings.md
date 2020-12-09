The Hack typechecker can also check that format strings are being used
correctly.

``` Hack
// Correct.
Str\format("First: %d, second: %s", 1, "foo");

// Typechecker error: Too few arguments for format string.
Str\format("First: %d, second: %s", 1);
```

This requires that the format string argument is a string literal.

``` Hack
$s = "Number is: %d";

// Typechecker error: Only string literals are allowed here.
Str\format($s, 1);
```

## Defining Functions with Format Strings

You can define your own functions with format string arguments too.

```define.hack no-auto-output
function takes_format_string(
  \HH\FormatString<\PlainSprintf> $format,
  mixed ...$args
): void {}

function use_it(): void {
  takes_format_string("First: %d, second: %s", 1, "foo");
}
```

`HH\FormatString<PlainSprintf>` will check that you've used the right
number of arguments. `HH\FormatString<Str\SprintfFormat>` will also
check that arguments match the type in the format string.
