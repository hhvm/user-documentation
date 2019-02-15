In general, an async operation has the following pattern:
* Call an `async` function
* Get an awaitable back
* `await` the awaitable to get a result

However, sometimes an async function can throw an exception. The good news is that the same exception object that would be thrown in the 
non-async version of the code will be returned when we `await` the awaitable.

@@ exceptions-examples/basic-exception.php @@

The use of `from_async` ignores any successful awaitable results and just throw an exception of one of the 
awaitable results, if one of the results was an exception.

@@ exceptions-examples/multiple-awaitable-exception.php @@

To get around this, and get the successful results as well, we can use the [utility function](utility-functions.md) 
[`HH\Asio\wrap`](/hack/reference/function/HH.Asio.wrap/). It takes an awaitable and returns the expected result or the exception 
if one was thrown. The exception it gives back is of the type [`ResultOrExceptionWrapper`](/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/).

```Hack
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
