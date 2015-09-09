# Async Wait Handles

A //wait handle// is the key construct in `async` code. A wait handle is a first-class Hack object that represents a possibly asynchronous operation that may or may not have completed. You get a concrete result if the operation has completed. Or you `await` the wait handle until the operation has completed. 

## Awaitable

Wait handles are represented through the Hack interface called `Awaitable`. While there are several classes that implement `Awaitable`, there is no need to concern yourself with their implementation details. `Awaitable` is the only interface you need. 

The type of the Awaitable will be the underlying type that the function would return if it wasn't async.

@@ wait-handles-examples/wait-handle-return.php @@

## Two types of wait handles

There are two types of wait handles. Single and collection.

### Single

One is the usual `Awaitable` that is returned from an `async` function.

@@ wait-handles-examples/single-wait-handle.php @@

Note that normally you will see something like `await f();` which combines the retrieving of the wait handle with the retrieving of the result of the wait handle. The example above separates it out for illustration purposes.

### Collection

The other is a wait handle representing a collection of other wait handles. To represent this type of wait handle you use one of the two built-in async helper functions in the `HH\Asio` namespace:

* `HH\Asio\v()`: Indexed list of wait handles with consecutive integer keys
* `HH\Asio\m()`: Associative map of wait handles with integer or string keys

@@ wait-handles-examples/multiple-wait-handles.php @@

## Join

Sometimes you want to get a result out of a wait handle when the function you are in **is not** `async`. For this there is `HH\Asio\join()`. Pass an `Awaitable` to `join()`.

Note: that global function calls (e.g., `main()`) require a join if that function is `async`). For example:

```
HH\Asio\join(main());
```

@@ wait-handles-examples/join.php @@

You should not call `join()` inside an `async` function. This would defeat the purpose of `async` as the the awaitable and any dependencies will run to completion synchronously, stopping any other awaitables in their tracks from running. Just `await` in an `async` function.
