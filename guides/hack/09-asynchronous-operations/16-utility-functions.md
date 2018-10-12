**NEEDS REVISING**

Async can be used effectively with the basic, built in infrastructure in HHVM. This basic infrastructure includes:
* [`async`](../asynchronous-operations/introduction.md), [`await`](../asynchronous-operations/awaitables), [`Awaitable`](../asynchronous-operations/awaitables)
* `HH\Asio\v()`, `HH\Asio\m()`

However, there are cases when we want to convert some collection of values to awaitables or we want to filter some awaitables out 
of a collection of awaitables. These types of scenarios come up when we are creating multiple awaitables to await in parallel. There 
is a set of utility functions to do this mapping and filtering., specifically created for async, that will make code more streamlined.

Name    | Returns             | Mapped | Filtered | Has Key | Wrapped Exception
--------|---------------------|--------|----------|---------|------------------
`HH\Asio\vm()`                    | `Vector<Tv>`        | ✓      | x        | x       | x
`HH\Lib\Vec\map_async`  | `vec<Tv>`        | ✓      | x        | x       | x
`HH\Asio\vmk()` | `Vector<Tv>`        | ✓      | x        | ✓       | x
`HH\Asio\vf()`  | `Vector<Tv>`        | x      | ✓        | x       | x
`HH\Asio\vfk()` | `Vector<Tv>`        | x      | ✓        | ✓       | x
`HH\Asio\vw()` | `Vector<ResultOrExceptionWrapper<Tv>>` | x      | x        | x       | ✓
`HH\Asio\vmw()` | `Vector<ResultOrExceptionWrapper<Tv>>`| ✓      | x        | x       | ✓
`HH\Asio\vmkw()` | `Vector<ResultOrExceptionWrapper<Tv>>`| ✓      | x        | ✓       | ✓
`HH\Asio\vfw()` | `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
`HH\Asio\vfkw()` | `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓
`HH\Asio\m()`   | `Map<Tk, Tv>`        | x      | x        | x       | x
`HH\Asio\mm()`  | `Map<Tk, Tv>`        | ✓      | x        | x       | x
`HH\Asio\mmk()` | `Map<Tk, Tv>`        | ✓      | x        | ✓       | x
`HH\Asio\mf()` | `Map<Tk, Tv>`        | x      | ✓        | x       | x
`HH\Asio\mfk()` | `Map<Tk, Tv>`        | x      | ✓        | ✓       | x
`HH\Asio\mw()` | `Map<Tk, ResultOrExceptionWrapper<Tv>>` | ✓      | x        | x       | ✓
`HH\Asio\mmw()`| `Map<Tk, ResultOrExceptionWrapper<Tv>>`| ✓      | x        | x       | ✓
`HH\Asio\mmkw()` | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| ✓      | x        | ✓       | ✓
`HH\Asio\mfw()` | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
`HH\Asio\mfkw()` | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓

From left-to-right in the function name, here is what the letters represent:
*First*
* `v`: Vector
* `m`: Map

*Second, Third*
* `f`: filter
* `fk`: filter with key
* `m`: map
* `mk`: map with keys

*Fourth*
* `w`: result or exception wrapper.

## Other Convenience Functions

There are three convenience-functions tailored for use with async. They are:

Name | Returns | Description
-----|---------|------------
`HH\Asio\usleep(int)` | `Awaitable<void>` | Wait a given length of time before an async function does more work.
`HH\Asio\later()` | `Awaitable<void>` | Reschedule the work of an async function until some undetermined point in the future.
`HH\Asio\wrap(Awaitable<Tv>)` | `Awaitable<ResultOrExceptionWrapper<Tv>>` | Wrap an `Awaitable` into an `Awaitable` of `ResultOrExceptionWrapper`.

## Type Checking Gotcha

Consider the following example:

```Hack

async function baz(): Awaitable<(X, int)> {
  list ($a, $b) = await \HH\Asio\v(
    vec[returns_an_X($foo), returns_an_int($bar)]);

// ****************************
  assert ($a is X);
  assert ($b is int);
// ****************************

  return tuple($a, $b);
}
```

`HH\Asio\v` takes a `Traversable<Awaitable<T>>` and returns an `Awaitable<Vector<T>>`. There is no `T` that can be both an `X` and 
an `int`. So, the type checker creates some sort of union type for `T` that tries to represent both of those. However, when we want 
to return the `tuple($a, $b)`, `$a` is an `X`, `b` is an `int`, but the type-checker doesn't realize that, since it thinks these should 
be the hybrid union type it created above. To resolve this, we need to explicitly assert what we know to be true in order to make the type checker happy.

The variadic function `HH\Asio\va` supports the following paradigm:

```Hack
va(Awaitable<T1>, Awaitable<T2>, ..., Awaitable<Tn>): Awaitable<(T1, T2, T3)>
```
