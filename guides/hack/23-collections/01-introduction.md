# Collections Introduction

In addition to supporting the one-size-fits-all `array` collection type, Hack also provides container types for specialized collections such as a vector, map and set. 

## Arrays

Hack supports the traditional PHP mechanism for expressing containers of elements: the array. Traditionally, the term "array" in programming languages is thought of as a collection of elements, indexed using consecutive integers (starting at 0 or 1). Hack arrays are significantly more flexible than the traditional concept of arrays. 

A Hack array is essentially a dictionary-style collection associating keys with values that maintains insertion order. The keys can be either integers or strings; the values can be of any type. Arrays are dynamically-sized and grow as needed without requiring a function call to increase their size/capacity.

In summary, a Hack array is a general purpose container for many different data structures. An array is also type-checkable, particularly when you associate a [type argument](../generics/introduction.md) with the array.

@@ introduction-examples/array.php @@

## Hack Collections 

While arrays provide maximum container flexibility, Hack collections provide maximum readability, along with possible performance benefits and better type-checkability as well.

### Readability

Imagine a 3rd party function declared like:

`function foo(array $arr): void {}`

Is this `array` a vector-style array with sequential integer keys? Is it a `map`-style array with maybe non-sequential integer keys, or string keys? What type of values is this array holding?

Now imagine this function declaration:

`function bar(Vector<string> $vec): void {}`

By looking at the function signature, we know that this function takes a Vector (sequential integer keys) with string values. 

### Performance

By knowing that the container is a vector or map, the runtime can make certain assumptions that allow for possible performance benefits when they are used. Also, by providing such constructs as immutable containers, the runtime can save memory by not having to allocate more memory than needed for the container.

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
**Vector** | Mutable, `int`eger-indexed, ordered sequence of values. Values can be of any type. The indicies start at `0` and end at `n-1`, where `n` is the number of elements.
**ImmVector** | A immutable version of `Vector`. Once the `ImmVector` is created, elements cannot be changed, removed or added.
**Map** | Mutable, `string` or `int`eger-indexed, ordered sequence of values. Values can be of any type. Order is remembered. This is most similar to the `array` in usage.
**ImmMap** | A immutable version of `Map`. Once the `ImmMap` is created, elements cannot be changed, removed or added.
**Set** | Mutable, ordered set of unique values. The values can be only `int` or `string`. There are no keys in a `Set`.
**ImmSet** | A immutable version of `Set`. Once the `SetMap` is created, elements cannot be changed, removed or added.
**Pair** | An immutable sequence of exactly two values. The keys are `0` and `1`. They are similar to [tuples](../types/type-system.md), but less flexible.

## Most Commonly Used Hack Collections

By far, the most commonly used Hack collections are `Vector`, `Map` and `Set` since they most mimic the `array` type.
