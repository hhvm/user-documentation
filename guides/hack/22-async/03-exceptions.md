# Async Exceptions

In general, async follows this pattern:

* call an `async` function
* get an awaitable back
* `await` the awaitable to get a result

However, sometimes an async function can throw an exception. The good news is that the same exception object that would be thrown in the non-async version of the code will be returned when you `await` the awaitable.

@@ exceptions-examples/basic-exception.php @@

Using the basic utility functions [`v()`](utility-functions.md) or [`m()`](utility-functions.md) will ignore any successful awaitable results and just throw an exception of one of the awaitable results, if one of the results was an exception.

@@ exceptions-examples/multiple-awaitable-exception.php @@

To get around this, and get the successful results as well, we can use the `asio-utilities` function called [`HH\Asio\wrap()`](utility-functions.md). It takes an awaitable and returns the expected result or the exception if one was thrown. The exception it gives back is of the type `ResultOrExceptionWrapper`.

```
namespace HH\Asio {
  interface ResultOrExceptionWrapper<T> {
    public function isSucceeded(): bool;
    public function isFailed(): bool;
    public function getResult(): T;
    public function getException(): \Exception;
  }
}
```

Taking the example above and using the wrapping mechanism, this is what the code looks like:

@@ exceptions-examples/wrapping-exceptions.php @@
