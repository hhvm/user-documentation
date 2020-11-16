In general, an async operation has the following pattern:
* Call an `async` function
* Get an awaitable back
* `await` the awaitable to get a result

However, sometimes an async function can throw an exception. The good news is that the same exception object that would be thrown in the
non-async version of the code will be returned when we `await` the awaitable.

```basic-exception.php
async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function basic_exception(): Awaitable<void> {
  // the handle does not throw, but result will be an Exception objection.
  // Remember, this is the same as:
  //   $handle = exception_thrower();
  //   await $handle;
  await exception_thrower();
}

<<__EntryPoint>>
function main(): void {
  \HH\Asio\join(basic_exception());
}
```

The use of `from_async` ignores any successful awaitable results and just throw an exception of one of the
awaitable results, if one of the results was an exception.

```multiple-awaitable-exception.php
async function exception_thrower(): Awaitable<void> {
  throw new \Exception("Return exception handle");
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function multiple_waithandle_exception(): Awaitable<void> {
  $handles = vec[exception_thrower(), non_exception_thrower()];
  // You will get a fatal error here with the exception thrown
  $results = await Vec\from_async($handles);
  // This won't happen
  \var_dump($results);
}

<<__EntryPoint>>
function main(): void {
  \HH\Asio\join(multiple_waithandle_exception());
}
```

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

```wrapping-exceptions.php
async function exception_thrower(): Awaitable<void> {
  throw new \Exception();
}

async function non_exception_thrower(): Awaitable<int> {
  return 2;
}

async function wrapping_exceptions(): Awaitable<void> {
  $handles = vec[
    \HH\Asio\wrap(exception_thrower()),
    \HH\Asio\wrap(non_exception_thrower()),
  ];
  // Since we wrapped, the results will contain both the exception and the
  // integer result
  $results = await Vec\from_async($handles);
  \var_dump($results);
}

<<__EntryPoint>>
function main(): void {
  \HH\Asio\join(wrapping_exceptions());
}
```
