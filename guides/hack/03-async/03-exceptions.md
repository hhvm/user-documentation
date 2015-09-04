# Async Exceptions

In general, async follows this pattern:

* call an `async` function
* get a wait handle
* `await` the wait handle to get a result

However, sometimes an async function can throw an exception. The good news is that the same exception object that would be thrown in the non-async version of the code is the same that will be returned when you `await` the wait handle.

@@ 03-exceptions-examples/basic-exception.php @@

Using the basic utility functions [`v()`](link to v) or [`m()`](link to m) will ignore any successful wait handle results and just throw an exception of one of the wait handle result if one of the results was an exception.

@@ 03-exceptions-examples/multiple-waithandle-exception.php @@

To get around this, and get the successful results as well, we can use the `asio-utilities` function called [`HH\Asio\wrap()`](link to wrap). It takes a wait handle and returns the expected result or the exception if one was thrown. The exception is gives back is of the type `ResultOrExceptionWrapper`.

```
namespace HH\Asio {

interface ResultOrExceptionWrapper<T> {
  public function isSucceeded(): bool;
  public function isFailed(): bool;
  public function getResult(): T;
  public function getException(): \Exception;
}
}

Taking the example above and using this mechanism:

@@ 03-exceptions-examples/wrapping-exceptions.php @@

And here is the output:

@@ 03-exceptions-examples/wrapping-exceptions.php.expectf @@
