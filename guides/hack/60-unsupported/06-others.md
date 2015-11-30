Here is a quick look at some other PHP features that are unsupported in Hack. Remember, when we say *unsupported*, we mean the following:

- The typechecker will issue an error in [strict mode](../typechecker/modes.md#strict-mode).
- The typechecker will either issue an error in partial mode, or will ignore (and not typecheck) the construct.
- These constructs will run unimpeded under HHVM when running PHP (not Hack) code.

## `eval()` and `create_function()`

It is impossible to accurately analyze type information statically with these functions.

## `extract()`

This is permitted and functional, even in [strict mode](../typechecker/modes.md#strict-mode), but it hides problems: Hack will not be able to check that any later uses of local variables is correct, as it is unable to know if they were affected by the `extract()` call. It is also frequently a security issue.

## Variable Variables

@@ others-examples/varvars.php.type-errors @@

There is no way to do type inference in a case like this. The typechecker can't know that what we meant by assigning `x` to `$val` was that we were going to use that `x` has a variable later on.

## Dynamic Properties

All class properties must be explicitly declared.

@@ others-examples/dynamic-properties.php.type-errors @@

## Aliasing of methods in traits

To preserve consistency and "greppability", the typechecker doesn't allow aliasing trait methods.

@@ others-examples/trait-aliasing.php.type-errors @@

The typechecker will issue a parsing error when you try this.

## Misc

- [Old style constructors](https://wiki.php.net/rfc/remove_php4_constructors)
- `global` as they act like references, which are already unsupported.
- `goto`
- `if...endif`
-  Incrementing and decrementing strings with `++` and `--`
-  `and`, `or`, `xor`. Instead use `&&`, `||` and `^` (even though the bitwise XOR has different precedence than logical XOR)
-  Arguments to `break` and `continue` (e.g, `break 2;`)
-  Case-insensitive function calls and class lookups
-  Mixing method call syntax (e.g., using `self` to call a non-static method)
- [Argument unpacking](https://wiki.php.net/rfc/argument_unpacking) with things other than arrays and collections
-  Array addition. Use [`array_merge`](http://php.net/manual/en/function.array-merge.php) or [`array_replace`](http://php.net/manual/en/function.array-replace.php) instead.
