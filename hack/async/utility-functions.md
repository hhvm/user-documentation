# Async Utility Functions

Async can be used effectively with the built-in infrastructure in HHVM. This infrastructure includes:

* `async`, `await`, `Awaitable`
* `HH\Asio\v()`, `HH\Asio\m()`

However, there are cases when you want to convert some collection of values to wait handles or you want to filter some wait handles out of a collection of wait handles. These type of scenarios come up when you are creating multiple wait handles to await in parallel. 

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
