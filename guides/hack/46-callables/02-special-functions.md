Hack provides these functions as safe alternatives to the `string` and `array`
callables that are supported in PHP, and the typechecker understands them - they
produce a callable with the same return and parameter types as the function
they reference.

An alternative is to [use lambdas](#about-lambdas).

## `fun()`

`fun()` converts a string function name into a typed callable:

@@ special-functions-examples/fun.php @@

If the function is in a namespace, then the fully qualified function name
(including the initial `\`) must be used.

## `inst_meth()`

`inst_meth()` converts an object and a public method name into a typed
callable:

@@ special-functions-examples/inst_meth.php @@

For private/protected methods, use [a lambda](/hack/lambdas/introduction)
instead.

## `class_meth()`

`class_meth()` converts a class name and a public static method name into
a typed callable:

@@ special-functions-examples/class_meth.php @@

Class names must be fully-qualified; this is easiest to do by using the
`Foo::class` constants. For private/protected methods, use
[a lambda](/hack/lambdas/introduction) instead.

## `meth_caller()`

`meth_caller()` takes:

 - a fully qualified class name or constant (like `class_meth()`)
 - a `public` method name (like `inst_meth()`)

The callable it produces takes an instance of the class as an additional
parameter.

@@ special-functions-examples/meth_caller.php @@

For private/protected methods, use a lambda instead.

## About Lambdas

These functions were created before [lambdas](/hack/lambdas/introduction) were
added to the language; lambdas often be both shorter and more readable than
these functions - e.g. the `meth_caller()` example above can be written as:

@@ special-functions-examples/lambda.php @@

This approach also allows the use of `private` and `protected` methods, or
properties, if created from an appropriate scope:

@@ special-functions-examples/lambda_pp.php @@
