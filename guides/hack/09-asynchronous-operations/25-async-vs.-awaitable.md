Why is the `async` keyword needed for functions that return `Awaitable`? Because it is possible to have non-async functions that
return awaitables; the `async` keyword is merely an implementation detail. For this reason, `async` is not allowed in interfaces. For example:

@@ async-vs.-awaitable-examples/interface.php @@

This can be implemented with an async function, like this:

@@ async-vs.-awaitable-examples/async-impl.php @@

It can also be implemented by a non-async function, like this:

@@ async-vs.-awaitable-examples/non-async-impl.php @@

The use of `async` is strongly encouraged for all functions, except for:
- Interface method declarations
- Abstract method declarations

The `async` keyword should be used in most other cases, including implementations of interface or abstract methods.

