HHVM does a runtime type check for function arguments and return
values.

``` Hack
function takes_int(int $_): void {}

function check_parameter(): void {
  takes_int("not an int"); // runtime error.
}

function check_return_value(): int {
  return "not an int"; // runtime error.
}
```

If a type is wrong, HHVM will raise a fatal error. This is controlled
with the HHVM option `CheckReturnTypeHints`. Setting it to 0 or 1 will
disable this.

## Partial Signatures

In partial mode, type hints are optional.

@@ type-enforcement-examples/add_items_partial.php @@

When `add_items` is called, HHVM will only check the type of `$y`. It
also will not the check type when `add_items` returns.

The typechecker will also only check `$y` when it runs. It will assume
that `$x` and the return value have the correct type. This unresolved
type is shown as `_` when hovering in the IDE.

Partial mode is intended to help users migrate to strict mode, and we
recommend you use strict mode as soon as you can.
