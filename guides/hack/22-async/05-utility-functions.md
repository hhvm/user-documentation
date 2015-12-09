Async can be used effectively with the basic, built in infrastructure in HHVM. This basic infrastructure includes:

* [`async`](/hack/async/introduction), [`await`](/hack/async/awaitables), [`Awaitable`](/hack/async/awaitables)
* [`HH\Asio\v()`](/hack/reference/function/HH.Asio.v/), [`HH\Asio\m()`](/hack/reference/function/HH.Asio.m/)

However, there are cases when you want to convert some collection of values to awaitables or you want to filter some awaitables out of a collection of awaitables. These types of scenarios come up when you are creating multiple awaitables to await in parallel. 

You can use functions like `array_filter()`, or the methods on the Hack collection classes, etc. to do this mapping and filtering. However, there is a set of utility functions, specifically created for async, that will make your code more streamlined. 

Note: These functions are built in to HHVM 3.11 and greater. If you are using a version of HHVM less than 3.11, you can add `hhvm/asio-utilities` to your `composer.json` file as these functions are available in the [`hhvm/asio-utilities` Github repo](https://github.com/hhvm/asio-utilities).

Name    | Returns             | Mapped | Filtered | Has Key | Wrapped Exception
--------|---------------------|--------|----------|---------|------------------
[`HH\Asio\v()`](/hack/reference/function/HH.Asio.v/)   | `Vector<Tv>`         | x      | x        | x       | x
[`HH\Asio\vm()`](/hack/reference/function/HH.Asio.vm/)  | `Vector<Tv>`        | ✓      | x        | x       | x
[`HH\Asio\vmk()`](/hack/reference/function/HH.Asio.vmk/) | `Vector<Tv>`        | ✓      | x        | ✓       | x
[`HH\Asio\vf()`](/hack/reference/function/HH.Asio.vf/)  | `Vector<Tv>`        | x      | ✓        | x       | x
[`HH\Asio\vfk()`](/hack/reference/function/HH.Asio.vfk/) | `Vector<Tv>`        | x      | ✓        | ✓       | x
[`HH\Asio\vw()`](/hack/reference/function/HH.Asio.vw/)  | `Vector<ResultOrExceptionWrapper<Tv>>` | x      | x        | x       | ✓
[`HH\Asio\vmw()`](/hack/reference/function/HH.Asio.vmw/) | `Vector<ResultOrExceptionWrapper<Tv>>`| ✓      | x        | x       | ✓
[`HH\Asio\vmkw()`](/hack/reference/function/HH.Asio.vmkw/)| `Vector<ResultOrExceptionWrapper<Tv>>`| ✓      | x        | ✓       | ✓
[`HH\Asio\vfw()`](/hack/reference/function/HH.Asio.vfw/) | `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
[`HH\Asio\vfkw()`](/hack/reference/function/HH.Asio.vfkw/)| `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓
[`HH\Asio\m()`](/hack/reference/function/HH.Asio.m/)   | `Map<Tk, Tv>`        | x      | x        | x       | x
[`HH\Asio\mm()`](/hack/reference/function/HH.Asio.mm/)  | `Map<Tk, Tv>`        | ✓      | x        | x       | x
[`HH\Asio\mmk()`](/hack/reference/function/HH.Asio.mmk/) | `Map<Tk, Tv>`        | ✓      | x        | ✓       | x
[`HH\Asio\mf()`](/hack/reference/function/HH.Asio.mf/)  | `Map<Tk, Tv>`        | x      | ✓        | x       | x
[`HH\Asio\mfk()`](/hack/reference/function/HH.Asio.mfk/) | `Map<Tk, Tv>`        | x      | ✓        | ✓       | x
[`HH\Asio\mw()`](/hack/reference/function/HH.Asio.mw/)  | `Map<Tk, ResultOrExceptionWrapper<Tv>>` | ✓      | x        | x       | ✓
[`HH\Asio\mmw()`](/hack/reference/function/HH.Asio.mmw/) | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| ✓      | x        | x       | ✓
[`HH\Asio\mmkw()`](/hack/reference/function/HH.Asio.mmkw/)| `Map<Tk, ResultOrExceptionWrapper<Tv>>`| ✓      | x        | ✓       | ✓
[`HH\Asio\mfw()`](/hack/reference/function/HH.Asio.mfw/) | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
[`HH\Asio\mfkw()`](/hack/reference/function/HH.Asio.mfkw/)| `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓

From left to right in the function name, here is what the letters represent:

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

In addition to the collections-based utility functions above, there are three other convenience functions specifically tailored to be used with async.

Name | Returns | Description
-----|---------|------------
[`HH\Asio\usleep(int)`](/hack/reference/function/HH.Asio.usleep/) | `Awaitable<void>` | Wait a provided length of time before an async function does more work.
[`HH\Asio\later()`](/hack/reference/function/HH.Asio.later/) | `Awaitable<void>` | Reschedule the work of an async function until some undetermined point in the future.
[`HH\Asio\wrap(Awaitable<Tv>)`](/hack/reference/function/HH.Asio.wrap/) | `Awaitable<ResultOrExceptionWrapper<Tv>>` | Wrap an `Awaitable` into an `Awaitable` of `ResultOrExceptionWrapper`.

## Type Checking Gotcha

Let's say you have the following:

```
async function baz(): Awaitable<(X, int)> {
  list ($a, $b) = 
    await \HH\Asio\v(array(
      returns_an_X($foo), 
      returns_an_int($bar),
    ));

  return tuple($a, $b);
}
```

And you want this to type check correctly. However, you get something like:

```
example.php:60:12,44: Invalid return type (Typing[4110])
  example.php:36:60,67: This is an object of type X
  example.php:25:61,63: It is incompatible with an int
```

That is because [`HH\Asio\v()`](/hack/reference/function/HH.Asio.v/) takes a `Traversable<Awaitable<T>>` and returns an `Awaitable<Vector<T>>`. There is no `T` that can be both an `X` and an `int`. So the type checker basically throws its hands up and creates some sort of union type for `T` that tries to represent both of those.

However, when you want to return the `tuple($a, $b)`, `$a` is an `X`, `b` is an `int`, but the type-checker doesn't realize that since it thinks these should be the hybrid union type it created above.

So we need to explicitly assert what we know to be true in order to make the type checker happy.

```
assert ($a instanceof X);
assert (is_int($b));
return tuple($a, $b);
```

In the future there will be a [variadic]() function `HH\Asio\va()` that will better support this paradigm. e.g, 

```
va(Awaitable<T1>, Awaitable<T2>, ..., Awaitable<Tn>): Awaitable<(T1, T2, T3)>
```

instead of the hybrid union that messed us up above.

### Create your own workaround function

Until `HH\Asio\va()` is fully supported, you could create your own version of a helper function that acts similarly. The following example takes two `Awaitable`s of possibly different types and, like above, returns a `tuple` of those two types. In this case you do not need any `assert`s, etc.

```
<?hh // strict

// Replace calls to these with calls to HH\Asio\va() when that is implemented
async function va2<Ta,Tb>(
  Awaitable<Ta> $a,
  Awaitable<Tb> $b,
): Awaitable<(Ta, Tb)> {
  $list = await v(Vector{$a, $b});
  // UNSAFE
  return tuple($list[0], $list[1]);
}
```

Interestingly enough, the above function was actually implemented in the [code](https://github.com/hhvm/user-documentation/blob/7568764b587b24f3a8441bee1f1ac6940cb5de7e/src/utils/async_funcs.php) that generates the Hack and HHVM documentation site.
