# Awaitables

An //awaitable// is the key construct in `async` code. An awaitable is a first-class Hack object that represents a possibly asynchronous operation that may or may not have completed. You get a concrete result if the operation has completed. Or you `await` the awaitable until the operation has completed. 

## `Awaitable`

Awaitables are represented through the Hack interface called `Awaitable`. While there are several classes that implement `Awaitable`, there is no need to concern yourself with their implementation details. `Awaitable` is the only interface you need. 

The type returned from an async function is `Awatiable<T>`, where `T` is the final result type (e.g., `int`) of the awaited value.

```
async function foo(): Awaitable<int> {...}
:
$x = foo(); // $x will be an Awaitable<int>
$x = await foo(); // $x will be an int
```

@@ awaitables-examples/wait-handle-return.php @@

## Two types of awaitables

There are two types of awaitables. Single and collection.

### Single

One is the usual `Awaitable` that is returned from an `async` function.

@@ awaitables-examples/single-awaitable.php @@

Note that normally you will see something like `await f();` which combines the retrieving of the awaitable with the retrieving of the result of the awaitable. The example above separates it out for illustration purposes.

### Collection

The other is an awaitable representing a collection of other awaitables. To represent this type of awaitable you use one of the two built-in async helper functions in the `HH\Asio` namespace:

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
