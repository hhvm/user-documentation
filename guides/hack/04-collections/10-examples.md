# Hack Collection Examples

The following are various examples on how to use Hack collections.

## Simple Vector Usage

The following example shows you a simple example on how to create, query, add items to and remove items from a `Vector`.

@@ examples-examples/vector.php @@

## Simple Map Usage

The following example shows you a simple example on how to create, query, add items to and remove items from a `Map`.

@@ examples-examples/map.php @@

## Using `filter()`

`filter()` allows you to create a collection that is a subset (which includes being empty) of the current collection by applying a condition on each item of the collection and if the condition is true for that element, it will be part of the new collection.

@@ examples-examples/filter-method.php @@

## Using `map()`

`filter()` allows you to create a collection that is a subset (which includes being empty) of the current collection by applying a condition on each item of the collection and if the condition is true for that element, it will be part of the new collection.

@@ examples-examples/map-method.php @@

## Reference Semantics

Hack collections have [reference semantics](./semantics.md#reference-semantics) while arrays have value semantics.

@@ examples-examples/reference.php @@

## Lazy

Hack collections provide a Scala-like *view* with the `lazy()` method. Normally, when you create an instance of a collection, you are creating a *strict* version of the collection. So, when you create a collectio that contains one million elements, memory is allocated for all one million of those elements immediately. However, with a *view* via `lazy()`, you can create a *non-strict* collection such that when you use a method like `map()` or `filter()` on the collection (i.e., a transformer method), the elements are only calculated when they are accessed.

This example shows you how to use `lazy()` on a rather large collection and the memory usage for both a *strict* and *non-strict* version of the collection.

@@ examples-examples/lazy.php @@

## Indexish

`Indexish` is an interface that represents a collection that can be indexed by a key. Keys in collections can either be a `string` or `int`. Thus, you can use `Indexish` to represent Hack collections that have one of those two key types.

@@ examples-examples/indexish.php @@

## Creating a new collection

The current [concrete](./04-classes.md) collection classes are marked as final. That is, they cannot be directly extended and subclassed. However, you can create new collection classes by using the [interfaces](./03-interfaces.md) provided. This example won't create a full-blown new collection since so many methods would have to be implemented from [`Iterable<T>`](./semantics.md#core-interfaces).

@@ examples-examples/simple-collection.php @@
