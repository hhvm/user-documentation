# Callables

The following is allowed in PHP:

@@ intro-examples/php-callable.php @@

The Hack typechecker ***does not*** allow the callable type hint.

@@ intro-examples/hack-callable-bad.php @@

However, Hack does offer a powerful alternative to the `callable` type hint through the `function` keyword

@@ intro-examples/hack-callable-good.php @@

## Syntax

The syntax for Hack callables is:

```
(function (<param type 1>,..., <param type n): <return type>) $<callback_name>
``

Since a callable is really a function, the syntax above should look like a function signature without the function and parameter names.

e.g., here is a callable that takes a `bool` and `int` and returns a `string`:

```
(function(bool, int): string) $callback;
```

## Allowed Callables

There are four (4) types of callables allowed in Hack that will pass the typechecker. Note that objects with the `__invoke()` method **are not** recognized as callable by the Hack typechecker.

### Closure

Closures work as you would expect.

@@ intro-examples/closure.php @@

### Function

You can pass a named function to an entity expecting a callable by verifying that function with the special function called `fun()`.

@@ intro-examples/function.php @@

### Instance Method

You can pass an instance method to an entity expecting a callable by verifying that method with `inst_meth()`.

@@ intro-examples/instance.php @@

### Static Method

You can pass a static method to an entity expecting a callable by verifying that method with `class_meth()`.

@@ intro-examples/static.php @@
