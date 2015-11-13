# Concrete Collection Classes

There are currently seven (7) Hack concrete collection classes that are available to instantiate. All of these classes derive from various levels of the [collection interfaces](./interfaces.md). 

Descriptions of each of the methods can be found in the [API reference](../reference/).

Example usage for each of these classes can be found in the [examples section of this guide](./examples.md) as well as an example for each API can be found in the [collections API examples](../../api-examples/collections-examples).

For each concrete collection class, only the methods defined by the class themselves are shown. You can see the derived methods from interface implementation in the [collection interfaces section](./interfaces.md).

## Mutable Collections

Class | Implements | Description | Defined Methods
------|------------|-------------|----------------
[`Vector<T>`](/hack/reference/class/Vector/) | [`MutableVector<T>`](/hack/reference/interface/MutableVector/) | A mutable sequence of values, indexed by sequential integers starting at 0. | [`__construct()`](/hack/reference/class/Vector/__construct/), [`linearSearch()`](/hack/reference/class/Vector/linearSearch/), [`pop`](/hack/reference/class/Vector/pop/), [`reserve()`](/hack/reference/class/Vector/reserve/), [`resize()`](/hack/reference/class/Vector/resize/), [`reverse()`](/hack/reference/class/Vector/reverse/), [`shuffle()`](/hack/reference/class/Vector/shuffle/), [`splice()`](/hack/reference/class/Vector/splice/), [`__toString()`](/hack/reference/class/Vector/__toString/)
[`Map<Tk, Tv>`](/hack/reference/class/Map/) | [`MutableMap<Tk, Tv>`](/hack/reference/interface/MutableMap/) | A mutable, ordered set of unique keys, each of which map to a value. | [`__construct()`](/hack/reference/class/Map/__construct/), [`fromItems()`](/hack/reference/class/Map/fromItems/), [`__toString()`](/hack/reference/class/Map/__toString/)
[`Set<T>`](/hack/reference/class/Set/) | [`MutableSet<T>`](/hack/reference/interface/MutableSet/) | A mutable, ordered set of unique values. | [`__construct()`](/hack/reference/class/Set/__construct/), [`fromArrays()`](/hack/reference/class/Set/fromArrays/), [`fromItems()`](/hack/reference/class/Set/fromItems/), [`removeAll()`](/hack/reference/class/Set/removeAll/), [`__toString()`](/hack/reference/class/Set/__toString/)

## Immutable Collections

Class | Implements | Description | Defined Methods
------|------------|-------------|----------------
[`ImmVector<T>`](/hack/reference/class/ImmVector/) | [`ConstVector<T>`](/hack/reference/interface/ConstVector/) | An immutable sequence of values, indexed by sequential integers starting at 0. | [`__construct()`](/hack/reference/class/ImmVector/__construct/), [`linearSearch()`](/hack/reference/class/ImmVector/linearSearch/), [`__toString()`](/hack/reference/class/ImmVector/__toString/)
[`ImmMap<Tk, Tv>`](/hack/reference/class/ImmMap/) | [`ConstMap<Tk, Tv>`](/hack/reference/interface/ConstMap/) | A immutable, ordered set of unique keys, each of which map to a value. | [`__construct()`](/hack/reference/class/ImmMap/__construct/), [`fromItems()`](/hack/reference/class/ImmMap/fromItems/), [`__toString()`](/hack/reference/class/ImmMap/__toString/)
[`ImmSet<T>`](/hack/reference/class/ImmSet/) | [`ConstSet<T>`](/hack/reference/class/ConstSet/) |  An immutable, ordered set of unique values. | [`__construct()`](/hack/reference/class/ImmSet/__construct/), [`fromArrays()`](/hack/reference/class/ImmSet/fromArrays/), [`fromItems()`](/hack/reference/class/ImmSet/fromItems/), [`__toString()`](/hack/reference/class/ImmSet/__toString/)
[`Pair<Tv1, Tv2>`](/hack/reference/class/Pair/ | [`ConstVector<T>`](/hack/reference/interface/ConstVector/) | An immutable, vector-like collection with two and only two values. | [`__construct()`](/hack/reference/class/Pair/__construct/), [`linearSearch()`](/hack/reference/class/Pair/linearSearch/), [`__toString()`]((/hack/reference/class/Pair/__toString/)
