In addition to fully supporting the one-size-fits-all PHP [`array`](http://php.net/types.array) container type, Hack allows additional typing to be placed on arrays, and provides a number of classes which implement more specialized collecion patterns.

## Array Typing

Arrays in Hack behave similarly to [`Generics`](/hack/generics/) in that additional type information may be provided about how they are specialized.  For example, an unindexed array of strings takes the form `array<string>`.  Similarly, for indexed arrays, the key type (`int` or `string`) may be specified first, followed by the value type.  So a dictionary with string keys and floating point values might look like `array<string, float>`.

Since the value side of an array may itself be an array (or a `Generic` class), type specialization may be nested as with `array<int, array<string, string>>` which is a numerically indexed array containing string dictionaries.

@@ introduction-examples/array.php @@

## Hack Collections 

While PHP Arrays are extremely versatile, that flexibility occaisionally comes at a cost either in terms of performance, correctness, or readability.  Hack Collection classes seek to resolve those issues by providing deeply specialized object versions of arrays in the form of common container patterns: [`Vector`](/hack/reference/class/Vector/), [`Map`](/hack/reference/class/Map/), and [`Set`](/hack/reference/class/Set/).

### Readability

Imagine a 3rd party function declared like:

`function foo(array<int, string> $arr): void {}`

Is this `array` a vector-style array with sequential integer keys? Or maybe a `map`-style array with potentially non-sequential integer keys? Are the values in this array unique?

Now imagine this function declaration:

`function bar(Vector<string> $vec): void {}`

By looking at the function signature, we know those integer keys are ordered and sequential.  That the actual key number is probably much less relevant that the thing its holding.

Similarly, if the function declaration were:

`function bar(Set<string> $set): void {}`

Then we realize that those integer keys were irrelevant, and that the strings contained in this parameter will all have unique values.

### Performance

The obvious benefit in `Vectors` and `Sets` are that the keys can be ignored by the runtime.  For `Vector`s that means layouting out the values contiguously and having fast lookup and iteration based on index.  In the case of `Set`s it actually means (as an implementation detail) turning the internal structure inside out, using the values as keys (which must be unique), and ignoring the other half of the array pair.  This is a pattern already available to PHP code, but it removes the cognitive overhead of having to remember that the array is inside out, and does it in a more efficient way than script code is able to do.

### Type Checking

Related to readability, the Hack typechecker cannot tell, for example, whether the context of your code is passing an `array` used like a vector to a function with a parameter of an `array` used like a map. For example, the following code passes the typechecker.

@@ introduction-examples/array-typecheck.php @@

However, if you take a similar style of code, but instead use `Vector` and `Map`, the typechecker can easily tell the intent.

@@ introduction-examples/map-typecheck.php.type-errors @@

Using Hack collections gives the typechecker more data to work with in trying to decide whether you have typing problems in your code.

### Type of Collections

There are seven collections in Hack:

Type | Description
-----|------------
[`Vector`](/hack/reference/class/Vector/) | Mutable, `int`eger-indexed, ordered sequence of values. Values can be of any type. The indicies start at `0` and end at `n-1`, where `n` is the number of elements.
[`ImmVector`](/hack/reference/class/ImmVector/) | An immutable version of `Vector`. Once the `ImmVector` is created, elements cannot be changed, removed or added.
[`Map`](/hack/reference/class/Map/) | Mutable, `string` or `int`eger-indexed, ordered sequence of values. Values can be of any type. Order is remembered. This is most similar to the `array` in usage.
[`ImmMap`](/hack/reference/class/ImmMap/) | An immutable version of `Map`. Once the `ImmMap` is created, elements cannot be changed, removed or added.
[`Set`](/hack/reference/class/Set/) | Mutable, ordered set of unique values. The values can be only `int` or `string`. There are no keys in a `Set`.
[`ImmSet`](/hack/reference/class/ImmSet/) | An immutable version of `Set`. Once the `SetMap` is created, elements cannot be changed, removed or added.
[`Pair`](/hack/reference/class/Pair/) | An immutable sequence of exactly two values. The keys are `0` and `1`. They are similar to [tuples](../types/type-system.md), but less flexible.

