# Awaitables

An *awaitable* is the key construct in `async` code. An awaitable is a first-class Hack object that represents a possibly asynchronous operation that may or may not have completed. You `await` the awaitable until the operation has completed. 

## `Awaitable`

Awaitables are represented through the Hack interface called `Awaitable`. While there are several classes that implement `Awaitable`, there is no need to concern yourself with their implementation details. `Awaitable` is the only interface you need. 

The type returned from an async function is `Awatiable<T>`, where `T` is the final result type (e.g., `int`) of the awaited value.

```
async function foo(): Awaitable<int> {...}
:
$x = foo(); // $x will be an Awaitable<int>
$x = await foo(); // $x will be an int
```

@@ awaitables-examples/awaitable-return.php @@

## Awaiting

All `async` functions must return an `Awaitable<T>`. When you call an `async` function, you will get back that `Awaitable`, at which point, you can `await` that `Awaitable` to wait for a result from the operation. When you `await`, you are blocking until the operation associated with the `Awaitable` is complete.

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

Sometimes you want to get a result out of an awaitable when the function you are in **is not** `async`. For this there is `HH\Asio\join()`. Pass an `Awaitable` to `join()`.

Note: that global function calls (e.g., `main()`) require a join if that function is `async`). For example:

```
HH\Asio\join(main());
```

@@ awaitables-examples/join.php @@

You should not call `join()` inside an `async` function. This would defeat the purpose of `async` as the the awaitable and any dependencies will run to completion synchronously, stopping any other awaitables in their tracks from running. Just `await` in an `async` function.
