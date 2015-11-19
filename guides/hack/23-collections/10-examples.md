# Hack Collection Examples

The following are various examples on how to use Hack collections.

## Simple Vector Usage

This simple example shows you how to create, query, add items to and remove items from a `Vector`.

@@ examples-examples/vector.php @@

## Simple Map Usage

This simple example shows you how to create, query, add items to and remove items from a `Map`.

@@ examples-examples/map.php.type-errors @@

## Using `filter()`

`filter()` allows you to create a collection that is a subset (which includes being empty) of the current collection by applying a condition on each item of the collection and if the condition is true for that element, it will be part of the new collection.

@@ examples-examples/filter-method.php @@

Note that we are using a [lambda](../../lambdas/introduction.md) to create the filtering operation. We could have also used a normal closure as well.

## Using `map()`

`map()` allows you to create a collection that has the same elements as the collection on which `map()` is called, but with some operation applied to each element.

@@ examples-examples/map-method.php @@

Note that we are using a [lambda](../../lambdas/introduction.md) to create the mapping operation. We could have also used a normal closure as well.

## Reference Semantics

Hack collections have [reference semantics](./semantics.md#reference-semantics) while arrays have value semantics.

@@ examples-examples/reference.php @@

## Lazy

Hack collections provide a Scala-like *view* with the `lazy()` method. Normally, when you create an instance of a collection, you are creating a *strict* version of the collection. So, when you create a collection that contains one million elements, memory is allocated for all one million of those elements immediately. However, with a *view* via `lazy()`, you can create a *non-strict* collection such that when you use a method like `map()` or `filter()` on the collection (i.e., a transformer method), the elements are only calculated when they are accessed.

This example shows you how to use `lazy()` on a rather large collection and the time for both a *strict* and *non-strict* version of the collection. Since we only need 5 of the elements in the end, the lazy view actually allows us to stop after we meet our required 5 without having to actually allocate all 10000000 elements up front.

@@ examples-examples/lazy.php @@

## Indexish

`Indexish` is an interface that represents a collection that can be indexed by a key. Keys in collections can either be a `string` or `int`. Thus, you can use `Indexish` to represent Hack collections that have one of those two key types.

@@ examples-examples/indexish.php @@

## Creating a New Collection

The current [concrete](./classes.md) collection classes are marked as final. That is, they cannot be directly extended and sub-classed. However, you can create new collection classes by using the [interfaces](./interfaces.md) provided. This example won't create a full-blown new collection since so many methods would have to be implemented from [`Iterable<T>`](./semantics.md#core-interfaces) with much more scrutiny and detail than what is presented here.

However, this example does show all the methods that would have to be implemented if you wanted to create a new set collection.

@@ examples-examples/simple-collection.php @@
