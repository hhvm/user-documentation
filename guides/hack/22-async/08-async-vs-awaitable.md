A common question is why the `async` keyword is needed for functions that return `Awaitable`. The keyword is required because it is possible to have non-async functions that return awaitables - the `async` keyword is merely an implementation detail. For this reason, `async` is not allowed in interfaces. For example:

@@ async-vs-awaitable-examples/interface.php @@

This can be implemented with an async function:

@@ async-vs-awaitable-examples/async-impl.php @@

It can also be implemented by a non-async function:

@@ async-vs-awaitable-examples/non-async-impl.php @@

Using `async` is strongly encouraged for all functions, except for:

- interface method declarations
- abstract method declarations

The `async` keywould should almost always be used in all other cases, including implementations of interface or abstract methods.
