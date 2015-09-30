# Concrete Collection Classes

There are currently six (6) Hack concrete collection classes that are available to instantiate. All of these classes derive from various levels of the [collection interfaces](./interfaces.md). 

Descriptions of each of the methods can be found in the [API reference](link to API reference).

Example usage for each of these classes can be found in the [examples section of this guide](./examples.md) as well as an example for each API can be found in the [collections API examples](../../api-examples/collections-examples).

For each concrete collection class, only the methods defined by the class themselves are shown. You can see the derived methods from interface implementation in the [collection interfaces section](./interfaces.md).

## Mutable Collections

Class | Implements | Description | Defined Methods
------|------------|-------------|----------------
`Vector<T>` | `MutableVector<T>` | A mutable sequence of values, indexed by sequential integers starting at 0. | `__construct()`, `linearSearch()`, `pop`, `reserve()`, `resize()`, `reverse()`, `shuffle()`, `splice()`, `__toString()`
`Map<Tk, Tv>` | `MutableMap<Tk, Tv>` | A mutable, ordered set of unique keys, each of which map to a value. | `__construct()`, `fromItems()`, `__toString()`
`Set<T>` | `MutableSet<T>` | A mutable, ordered set of unique values. | `__construct()`, `fromArrays()`, `fromItems()`, `removeAll()`, `__toString()`

## Immutable Collections

Class | Implements | Description | Defined Methods
------|------------|-------------|----------------
`Vector<T>` | `ConstVector<T>` | An immutable sequence of values, indexed by sequential integers starting at 0. | `__construct()`, `linearSearch()`, `__toString()`
`Map<Tk, Tv>` | `ConstMap<Tk, Tv>` | A immutable, ordered set of unique keys, each of which map to a value. | `__construct()`, `fromItems()`, `__toString()`
`Set<T>` | `ConstSet<T>` |  An immutable, ordered set of unique values. | `__construct()`, `fromArrays()`, `fromItems()`, `__toString()`
