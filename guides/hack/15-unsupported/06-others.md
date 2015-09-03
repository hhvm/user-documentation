Here is a quick look at some other PHP features that are unsupported in Hack. Remember, when we say *unsupported*, we mean the following:

- The typechecker will definitely error in [strict mode](../17-typechecker/05-modes.md), or just ignore the construct altogether.
- The typechecker may or may not error in partial mode, but will definitely not typecheck the construct, or just ignore the construct altogether.
- Most of the time, these constructs will run unimpeded under HHVM.

## `eval()` and `create_function()`

It is impossible to accurately analyze type information statically with these functions.

## `extract()`

You will get no typechecker errors, even in [strict mode](../17-typechecker/05-modes.md), but all local variable guarantees are removed as the typechecker will just assume the values are the same as before the call.

## Variable Variables

@@ others-examples/varvars.php @@

There is no way to do type inference in a case like this. How can the typechecker know that what we meant by assigning `x` to `$val` was that we were going to use that `x` has a variable later on.

## Dynamic Properties

All class properties must be explicitly declared.

@@ others-examples/dynamic-properties.php @@

## Aliasing of methods in traits

The typechecker doesn't understand aliasing trait methods. It actually believes it is a parse error.

@@ others-examples/trait-aliasing.php @@

## Others

- [Old style constructors](https://wiki.php.net/rfc/remove_php4_constructors)
- `global` as they act lack references, which are already unsupported.
- `goto`
- `if...endif`
-  Incrementing and decrementing strings with `++` and `--`
-  `and`, `or`, `xor`. Instead use `&&`, `||` and `^` (even though the bitwise XOR has different precedence than logical XOR)
-  Arguments to `break` and `continue` (e.g, `break 2;`)
-  Case-insensitive function calls and class lookups
-  Mixing method call syntax (e.g., using `self` to call a non-static method)
-  Hack supports [argument unpacking](https://wiki.php.net/rfc/argument_unpacking), except for on arbitrary traversables.

