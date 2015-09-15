# Async Utility Functions

Async can be used effectively with the built-in infrastructure in HHVM. This infrastructure includes:

* `async`, `await`, `Awaitable`
* `HH\Asio\v()`, `HH\Asio\m()`

However, there are cases when you want to convert some collection of values to awaitables or you want to filter some awaitables out of a collection of awaiables. These type of scenarios come up when you are creating multiple awaitables to await in parallel. 

You can use functions like `array_filter()`, or the methods on the Hack collection classes, etc. to do this mapping and filtering. But there exists a whole collection of concise and simply named utility functions that will make your code more streamlined. 

Note: These functions are in the [`hhvm/asio-utilities` Github repo](https://github.com/hhvm/asio-utilities).

Name    | Returns             | Mapped | Filtered | Has Key | Wrapped Exception
--------|---------------------|--------|----------|---------|------------------
`v()`   | `Vector<T>`         | x      | x        | x       | x
`vm()`  | `Vector<Tr>`        | ✓      | x        | x       | x
`vmk()` | `Vector<Tr>`        | ✓      | x        | ✓       | x
`vf()`  | `Vector<Tv>`        | x      | ✓        | x       | x
`vfk()` | `Vector<Tv>`        | x      | ✓        | ✓       | x
`vw()`  | `Vector<ResultOrExceptionWrapper<T>>` | x      | x        | x       | ✓
`vmw()` | `Vector<ResultOrExceptionWrapper<Tr>>`| ✓      | x        | x       | ✓
`vmkw()`| `Vector<ResultOrExceptionWrapper<Tr>>`| ✓      | x        | ✓       | ✓
`vfw()` | `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
`vfkw()`| `Vector<ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓
`m()`   | `Map<Tk, Tv>`        | x      | x        | x       | x
`mm()`  | `Map<Tk, Tr>`        | ✓      | x        | x       | x
`mmk()` | `Map<Tk, Tr>`        | ✓      | x        | ✓       | x
`mf()`  | `Map<Tk, Tv>`        | x      | ✓        | x       | x
`mfk()` | `Map<Tk, Tv>`        | x      | ✓        | ✓       | x
`mw()`  | `Map<Tk, ResultOrExceptionWrapper<T>>` | ✓      | x        | x       | ✓
`mmw()` | `Map<Tk, ResultOrExceptionWrapper<Tr>>`| ✓      | x        | x       | ✓
`mmkw()`| `Map<Tk, ResultOrExceptionWrapper<Tr>>`| ✓      | x        | ✓       | ✓
`mfw()` | `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | x       | ✓
`mfkw()`| `Map<Tk, ResultOrExceptionWrapper<Tv>>`| x      | ✓        | ✓       | ✓

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

If there is also an `f` that means:

* If filter function returns `true`, wrapped element is returned; `false`, the element is omitted; `throw`s, the wrapped exception is returned.

See [examples](link to examples) for how to use some of these utility functions.

## Type Checking Gotcha

Let's say you have the following:

```
function baz(): Awaitable<(X, int)> {
:
:
  list ($a, $b) = 
    await \HH\Asio\v(array(
      returns_an_X($foo), 
      returns_an_int($bar),
    ));
:
:
  return tuple($a, $b);
}
```

And you want this to type check correctly. However, you get something like:

```
example.php:60:12,44: Invalid return type (Typing[4110])
  example.php:36:60,67: This is an object of type X
  example.php:25:61,63: It is incompatible with an int
```

That is because `HH\Asio\v()` takes an `Traversable<Awaitable<T>>` and return an `Awaitable<Vector<T>>`. There is no `T` that can be both an `X` and an `int`. So the type checker basically throws its hands up and creates a some sort of union type for `T` that tries to represent both of those.

However, when you want to return the `tuple($a, $b)`, `$a` is an `X`, `b` is an `int`, but the type-checker doesn't realize that since it thinks these should be the hybrid union type it created above.

So we need to explictly assert what we know to be true in order to make the type checker happy.

```
assert ($a instanceof X);
assert (is_int($b);
return tuple($a, $b);
```

In the future there will be function `HH\Asio\va()` that will better support this paradigm. e.g, `va(Awaitable<T1>, Awaitable<T2>` instead of the hybrid union that messed us up above.

