# Collection Interfaces

The [concrete Hack collection classes](./classes.md) are generally derived from various interfaces. In normal usage, you will not have to deal with these interfaces, but we will list them for your reference. 

Descriptions of each of the interface methods can be found in the [API reference](link to API reference).

## Core Interfaces

These are the interfaces that allow for iteration, conversion (e.g., `toVector()`) and manipulation (e.g., `filter`).

Interface | Description | Key Methods
----------|-------------|------------
`Traversable<T>` | Anything that can be iterated over using `foreach` without a key. | N/A
`KeyedTraversable<Tk, Tv>` | Extends `Traversable<T>` and allows a key to be used in your `foreach` statement. | N/A
`Container<T>` | Extends `Traversable<T>`, but only includes arrays and Hack collections | N/A
`KeyedContainer<Tk, Tv>` | Extends `KeyedTraversable<Tk, Tv>`, but only includes arrays and Hack collections (except for `Set` and `ImmSet` since they don't have keys) | N/A
`Indexish<Tk, Tv>` | Extends `KeyedTraversable<Tk, Tv>` and is anything that can be an index in an array or collection, which in this case is `string` and `int`. It is somewhat common to have a method take an `Indexish` or return an `Indexish`. | N/A
`IteratorAggregate<T>` | Extends `Traversable<T>` and can produce an `Iterator`. Not implemented by arrays. Rarely directly used. | `getIterator()`
`Iterable<T>` | Extends `IteratorAggerate<T>` and is the **primary** interface that declares the methods that provides the capabilities for Hack collections. | `toArray()`, `toValuesArray()`, `toVector()`, `toImmVector()`, `toSet()`, `toImmSet()`, `lazy()`, `values()`, `map<Tm>((function(T): Tm) $callback)`, `filter((function(T): bool) $callback)`, `zip<Tz>(Traversable<Tz> $traversable)`
`KeyedIterable<Tk, Tv>`, `take()`, `takeWhile()`, `skip()`, `skipWhile()`, `slice()`, `concat()`, `firstValue()`, `lastValue()` | Extends `Iterable<Tv>` and adds key capabilities | `toKeysArray()`, `toMap()`, `keys()`, `lazy()`, `take()`, `takeWhile()`, `skip()`, `skipWhile()`, `firstKey()`, `lastKey()`, `mapWithKey<Tm>(function(Tk, Tv): Tm $callback)`, `filterWithKey(function(Tk, Tv): bool $callback)`, `getIterator()`, `map<Tm>(function(T): Tm $callback)`, `filter(function(T): bool $callback)`, `zip<Tz>(Traversable<Tz> $traversable)`

## General Collection Interfaces

These interfaces persist amongst all collections, providing basic methods for querying and adding.

Interface | Description | Key Methods
----------|-------------|------------
`ConstCollection<T>` | Read-only collection. All collections implement this interface. | `count()`, `isEmpty()`, `items()`
`OutputCollection<T>` | Mutable collection. All mutable collections implement this interface. | `add()`, `addAll()`
`Collection<T>` | Extends `ConstCollection<T>` and `OutputCollection<T>`. Combines the read-only and mutable collection behavior. | N/A

## Specific Collection Interfaces

Each [concrete Hack collection class](./classes.md) implements the appropriate interface listed here associated with that class.

Interface | Description | Key Methods
----------|-------------|------------
`ConstSet<T>` | Extends `ConstCollection<T>` and `KeyedIterable<mixed, T>` and represents a read-only set. | `contains()`
`MutableSet<T>` | Extends `ConstSet<T>` and `Collection<T>` and represents a mutable set. | `clear()`, `remove()`
`ConstVector<T>` | Extends `ConstCollection<T>` and `KeyedIterable<int, T>` and represents a read-only vector (sequence of values). | `at()`, `contains()`, `get()`
`MutableVector<T>` | Extends `ConstVector<T>` and `Collection<T>` and represents a mutable vector. | `clear()`, `removeKey()`, `set()`, `setAll()`, `remove()`
`ConstMap<Tk, Tv>` | Extends `ConstCollection<Pair<Tk, Tv>>` and `KeyedIterable<Tk, Tv>` and represents a read-only mapping of keys Tk to values Tv. | `at()`, `contains()`, `containsKey()`, `get()`
`MutableMap<Tk, Tv>` | Extends `ConstMap<T>` and `Collection<Pair<Tk, Tv>>` and represents a mutable map. | `clear()`, `remove()`, `removeKey()`, `set()`, `setAll()`
