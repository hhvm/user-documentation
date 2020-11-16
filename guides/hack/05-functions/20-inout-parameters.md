Hack functions normally pass arguments by value. `inout` provides
"copy-in, copy-out" arguments, which allow you to modify the variable
in the caller.

```basic.hack no-auto-output
function takes_inout(inout int $x): void {
  $x = 1;
}

function call_it(): void {
  $num = 0;
  takes_inout(inout $num);

  // $num is now 1.
}
```

This is similar to copy-by-reference, but the copy-out only happens
when the function returns. If the function throws an exception, no
changes occur.

``` Hack
function takes_inout(inout int $x): void {
  $x = 1;
  throw new Exception();
}

<<__EntryPoint>>
function call_it(): void {
  $num = 0;
  try {
    takes_inout(inout $num);
  } catch (Exception $_) {
  }

  // $num is still 0.
}
```

`inout` must be written in both the function signature and the
function call. This is enforced in the typechecker and at runtime.

## Indexing with `inout`

In addition to local variables, `inout` supports indexes in value
types.

```value_index.hack no-auto-output
function set_to_value(inout int $item, int $value): void {
  $item = $value;
}

function use_it(): void {
  $items = vec[10, 11, 12];
  $index = 1;
  set_to_value(inout $items[$index], 42);

  // $items is now vec[10, 42, 12].
}
```

This works for any value type: `vec`, `dict`, `keyset` or `array`. You
can also do nested access e.g. `inout $foo[$y][z()]['stuff']`.

## Dynamic Usage

`inout` is a different calling convention, so dynamic calls will not
work with `inout` parameters. For example, you cannot use
`meth_caller`, `call_user_func` or `ReflectionFunction::invoke`.

`unset` on a `inout` parameter will set the value to `null`. This is
not recommended, and will raise a warning when the function returns.

## References (deprecated)

Hack used to support references in partial mode files.

``` Hack
function set_to_zero(int &$x): void {
  $x = 0;
}
```

References allowed multiple mutable accesses to the same value. This
prevented HHVM relying on copy-on-write behaviors of value types,
making it slower.

It was also possible to confuse the typechecker (which assumed
variable wouldn't change types across function calls) and readers of
your code (especially when using `async` or `__Memoize`).

### Migrating to `inout`

HHVM allows references and `inout` parameters to be used
interchangeably. This allows you to gradually migrate your code.

`inout` parameters do not support default values, so you will need to
split up functions that have optional references.

``` Hack
function call_foo(int $x, int &$result = null): void {
  $foo_result = foo($x);
  
  // If provided, save the output to $result.
  if ($result !== null) {
    $result = $foo_result;
  }
}
```

Instead, write a separate function that makes the parameter required.

``` Hack
function call_foo(int $x): void {
  foo($x);
}

function call_foo_save_result(int $x, inout int $result): void {
  $foo_result = foo($x);
  $result = $foo_result;
}
```

This is how built-in functions like `preg_match` were migrated.
