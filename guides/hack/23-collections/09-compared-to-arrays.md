# Hack Collections vs. Arrays

Hack collections and arrays are similar in some respects, with one generally being more specific than the other. There are also some differences as well.

## Choosing

The following summary provides a general guide on when you should use a Hack collection vs. an array. In general, new Hack code should make use of collections where possible; but arrays will still be supported in a first-class way as well.

Use `array`s when:

- You are interacting with built-in functions that modify arrays *except* for [`array_push()`](http://php.net/manual/en/function.array-push.php), [`array_pop()`](http://php.net/manual/en/function.array-pop.php), [`array_shift()`](http://php.net/manual/en/function.array-shift.php), [`array_unshift()`](http://php.net/manual/en/function.array-unshift.php).
- You are interacting with built-in functions that modify an array's internal pointer like [`current()`](http://php.net/manual/en/function.current.php) and [`next()`](http://php.net/manual/en/function.current.php).
- You are interacting with built-in functions that have different behavior based on the type of parameter you pass it, like [`apc_store()`](http://php.net/manual/en/function.apc-store.php).
- You are passing the container around by reference `&`.
- You are passing the container to a *non built-in* function that takes an `array` as a parameter (e.g. in a custom framework).
- You need [value semantics](./semantics.md).

Otherwise, a collection should be quite suitable for your workflow.

## Semantics

The following table provides some semantic differences and similarities between arrays and collections.

Array | Collection
------|-----------
`array` | Can be any type of collection
`array<T>` | This will be similar to a `Vector`
`array<Tk, Tv>`, where `Tk` is `int` or `string` | This will be similar to a `Map`
`array (X, Y)` | This is similar to a `Pair`, assuming you add nothing more to the array
Nothing built-in similar to an immutable collection |  `ImmVector`, `ImmMap`, `ImmSet`
Nothing built-in similar to a `Set` since all arrays are indexable by key and can have duplicate values | `Set`
value semantics (copy of array do not reflect changes to original array) | reference semantics (copy of collection does reflect changes to original collection) 
