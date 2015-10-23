# Hack Collections vs. Arrays

Hack collections and arrays are similar in some respects, with one generally being more specific than the other. There are also some differences as well.

## Choosing

The following flowchart provides a general guide on when you should use a Hack collection vs. an array. In general, new Hack code should make use of collections where possible; but arrays will still be supported in a first-class way as well.

![Container Flow Chart](/images/container-flow.png)

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
