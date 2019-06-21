Functions must declare their input and output types in the signature.

@@ function-signatures-examples/add_one.php @@

When the type checker runs, `hh` will ensure that `add_one` is always
used correctly.

Type signatures also affect runtime. When `add_one` is called, its
arguments are checked against the signature. The return value is also
checked against the declared return type.

Arguments of the wrong type will produce a fatal error, and returning
a value of the wrong type will produce a fatal error unless the HHVM
option `CheckReturnTypeHints` is set to 0 or 1.

## Partial Signatures

In partial mode, type hints are optional.

@@ function-signatures-examples/add_items_partial.php @@

The type checker will only check the second argument `$y` to
`add_items`. It will assume that `$x` and the return type are the
correct type, and won't check them. This is the unresolved type, and
is shown as `_` in IDE tooltips.

At runtime, type hints will still be checked. In this example, the
wrong type for `$y` will produce a fatal error as before.

Partial mode is intended to help users migrate to strict mode, and we
recommend you use strict mode as soon as you can.

## Function Types

Type hints can also specify function types.

``` Hack
function apply_to_vec(vec<int> items, (function(int): int) $f): vec<int> {
   return Vec\map(items, $f);
}
```

The general syntax for function types is:

```
(function(INPUT-TYPE*): RETURN-TYPE)
```

## noreturn

A function that never returns a value can be annotated with the
`noreturn` type. A `noreturn` function either loops forever, throws an
an error, or calls another `noreturn` function.

``` Hack
function something_went_wrong(): noreturn {
  throw new Exception('something went wrong');
}
```

`exit` is an example of a library function with a `noreturn` type.
