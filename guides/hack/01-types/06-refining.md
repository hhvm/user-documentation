Suppose you want to take a given type and refine (upcast) that type to another type. Hack allows this through using the following in control-flow situations:

- checking for `null`
- type-querying (e.g., via `is_float()``)
- using `instanceof`

## Invariant

There is also a special function:

- `invariant(<bool expression of fact>, "Message if not")`

that can be used outside control-flow situation. It is essentially an assert to the typecheker that what you claim in the boolean statement is fact and true.

In any of the refining scenarios below, you can use `invariant()` as opposed to the conditional check.

## Nullable to Non-Nullable

Remember that a nullable type allows the value of a variable to be of its type or `null`. There are times when you want to utilize only the non-`null` part of that type. You can refine the nullable type with null checks

@@ refining-examples/nullable.php @@

## Mixed to Primitive

Remember that `mixed` represent any annotatable type (except a nullable type). `mixed` can be refined into a more specific primitive type through the use of built-in type querying functions such as [`is_int()`](http://php.net/manual/en/function.is-int.php), [`is_float()`](http://php.net/manual/en/function.is-float.php), [`is_string()`](http://php.net/manual/en/function.is-string.php), etc.

@@ refining-examples/mixed.php

## Object instance checks

Sometimes you want to know whether an object is a child of a parent class or implements a particular interface. You can use the `instanceof` check to help make this determination. 

@@ refining-examples/object.php

### `instanceof` Gotcha

Take a look at this example.

@@ refining-examples/unresolved.php

Even though `bar()` was passed in a `Base`, and all children of `Base` implement `foo()`, once the `instanceof` check was done on `$b`, and the check returned `true`, the typechecker has to assume that `$b` is now an unresolved type of both `Base` and `I`. And since not all implementers of `I` have to be in the hierarchy of `Base`, we cannot guarantee that `foo()` is available any longer.
