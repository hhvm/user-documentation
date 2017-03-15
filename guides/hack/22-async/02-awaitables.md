An *awaitable* is the key construct in `async` code. An awaitable is a first-class Hack object that represents a possibly asynchronous operation that may or may not have completed. You `await` the awaitable until the operation has completed. 

## `Awaitable`

Awaitables are represented through the Hack interface called `Awaitable`. While there are several classes that implement `Awaitable`, there is no need to concern yourself with their implementation details. `Awaitable` is the only interface you need. 

The type returned from an async function is `Awaitable<T>`, where `T` is the final result type (e.g., `int`) of the awaited value.

```
async function foo(): Awaitable<int> {...}

$x = foo(); // $x will be an Awaitable<int>
$x = await foo(); // $x will be an int
```

@@ awaitables-examples/awaitable-return.php @@

All `async` functions must return an `Awaitable<T>`. Calling an `async` function will therefore yield an object implementing the `Awaitable` interface, and you must `await` or `join` it to obtain an end result from the operation. When you `await`, you are pausing the current task until the operation associated with the `Awaitable` handle is complete, leaving other tasks free to continue executing. `join` is similar, however it blocks all other operations from completing until the `Awaitable` has returned.

## Awaiting

In most cases, you will prefer to `await` an `Awaitable` so that other tasks can execute while your blocking operation completes.  Note however, that only `async` functions can yield control to other asyncs, so `await` may therefore only be used in an `async` function.  For other locations, such as a `main` block, you will need to use `join`, outlined later in this section.

### Batching Awaitables

Many times you will `await` on one `Awaitable`, get the result and move on. 

@@ awaitables-examples/single-awaitable.php @@

You will normally see something like `await f();` which combines the retrieving of the awaitable with the waiting and retrieving of the result of that awaitable. The example above separates it out for illustration purposes.

Other times, you will gather up a bunch of awaitables and `await` them all before moving on.

Here we are using one of the two built-in async helper functions in the `HH\Asio` namespace in order to batch a bunch of awaitables together to then `await` upon:

* `HH\Asio\v()`: Indexed list of awaitables with consecutive integer keys
* `HH\Asio\m()`: Associative map of awaitables with integer or string keys

@@ awaitables-examples/multiple-awaitables.php @@

## Join

Sometimes you want to get a result out of an awaitable when the function you are in **is not** `async`. For this there is `HH\Asio\join()` which takes an `Awaitable` and blocks until it resolves into a result.

This means that invocations of async functions from the global scope (aka pseudomain) cannot be awaited, and must be joined.

@@ awaitables-examples/join.php @@

You should not call `join()` inside an `async` function. This would defeat the purpose of `async` as the awaitable and any dependencies will run to completion synchronously, stopping any other awaitables in their tracks from running. Just `await` in an `async` function.
