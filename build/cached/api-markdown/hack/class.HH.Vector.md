``` yamlmeta
{
    "name": "HH\\Vector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




` Vector ` is a stack-like collection




HHVM provides a native implementation
for this class. The PHP class definition below is not actually used at run
time; it is simply provided for the typechecker and for developer reference.




Like all objects in PHP, ` Vector `s have reference-like semantics. When a
caller passes a `` Vector `` to a callee, the callee can modify the ``` Vector ``` and
the caller will see the changes. ```` Vector ````s do not have "copy-on-write"
semantics.




` Vector `s only support integer keys. If a non-integer key is used, an
exception will be thrown.




` Vector `s support `` $m[$k] `` style syntax for getting and setting values by
key. ``` Vector ```s also support ```` isset($m[$k]) ```` and ````` empty($m[$k]) ````` syntax, and
they provide similar semantics as arrays. Elements can be added to a
`````` Vector `````` using ``````` $m[] = .. ``````` syntax.




` Vector `s do not support iterating while new elements are being added or
elements are being removed. When a new element is added or removed, all
iterators that point to the `` Vector `` shall be considered invalid.




` Vector `s do not support taking elements by reference. If binding assignment
(`` =& ``) is used with an element of a ``` Vector ```, or if an element of a ```` Vector ````
is passed by reference, or if a ````` Vector ````` is used with `````` foreach `````` by
reference, an exception will be thrown.




## Interface Synopsis




``` Hack
namespace HH;

final class Vector implements \MutableVector {...}
```




### Public Methods




+ [` ::fromArray(\darray<\arraykey, \Tv> $arr): Vector<\Tv> `](</hack/reference/class/HH.Vector/fromArray/>)\
  Returns a `` Vector `` containing the values from the specified ``` array ```
+ [` ::fromItems(?Traversable<\Tv> $iterable): Vector<\Tv> `](</hack/reference/class/HH.Vector/fromItems/>)\
  Creates a `` Vector `` from the given ``` Traversable ```, or an empty ```` Vector ```` if
  ````` null ````` is passed
+ [` ::fromKeysOf<\Tk as arraykey>(?KeyedContainer<\Tk, \mixed> $container): Vector<\Tk> `](</hack/reference/class/HH.Vector/fromKeysOf/>)\
  Creates a `` Vector `` from the keys of the specified container
+ [` ->__construct(?Traversable<\Tv> $iterable = NULL): \void `](</hack/reference/class/HH.Vector/__construct/>)\
  Creates a `` Vector `` from the given ``` Traversable ```, or an empty ```` Vector ````
  if ````` null ````` is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.Vector/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.Vector/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.Vector/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.Vector/__toString/>)\
  Returns the `` string `` version of the current ``` Vector ```, which is ```` "Vector" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.Vector/__unset/>)
+ [` ->add(\Tv $value): Vector<\Tv> `](</hack/reference/class/HH.Vector/add/>)\
  Appends a value to the end of the current `` Vector ``, assigning it the next
  available integer key
+ [` ->addAll(?Traversable<\Tv> $iterable): Vector<\Tv> `](</hack/reference/class/HH.Vector/addAll/>)\
  For every element in the provided `` Traversable ``, append a value into this
  ``` Vector ```, assigning the next available integer key for each
+ [` ->addAllKeysOf(?KeyedContainer<\Tv, \mixed> $container): Vector<\Tv> `](</hack/reference/class/HH.Vector/addAllKeysOf/>)\
  Adds the keys of the specified container to the current `` Vector ``
+ [` ->append(\mixed $val): object `](</hack/reference/class/HH.Vector/append/>)
+ [` ->at(int $key): \Tv `](</hack/reference/class/HH.Vector/at/>)\
  Returns the value at the specified key in the current `` Vector ``
+ [` ->clear(): Vector<\Tv> `](</hack/reference/class/HH.Vector/clear/>)\
  Removes all the elements from the current `` Vector ``
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): Vector<\Tu> `](</hack/reference/class/HH.Vector/concat/>)\
  Returns a `` Vector `` that is the concatenation of the values of the current
  ``` Vector ``` and the values of the provided ```` Traversable ````
+ [` ->contains(\mixed $key): bool `](</hack/reference/class/HH.Vector/contains/>)
+ [` ->containsKey(\mixed $key): bool `](</hack/reference/class/HH.Vector/containsKey/>)\
  Determines if the specified key is in the current `` Vector ``
+ [` ->count(): int `](</hack/reference/class/HH.Vector/count/>)\
  Returns the number of elements in the current `` Vector ``
+ [` ->filter(\callable $callback): Vector<\Tv> `](</hack/reference/class/HH.Vector/filter/>)\
  Returns a `` Vector `` containing the values of the current ``` Vector ``` that meet
  a supplied condition
+ [` ->filterWithKey(\callable $callback): \ Vector<\Tv> `](</hack/reference/class/HH.Vector/filterWithKey/>)\
  Returns a `` Vector `` containing the values of the current ``` Vector ``` that meet
  a supplied condition applied to its keys and values
+ [` ->firstKey(): ?int `](</hack/reference/class/HH.Vector/firstKey/>)\
  Returns the first key in the current `` Vector ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.Vector/firstValue/>)\
  Returns the first value in the current `` Vector ``
+ [` ->get(int $key): ?\Tv `](</hack/reference/class/HH.Vector/get/>)\
  Returns the value at the specified key in the current `` Vector ``
+ [` ->getIterator(): Rx\KeyedIterator<int, \Tv> `](</hack/reference/class/HH.Vector/getIterator/>)\
  Returns an iterator that points to beginning of the current `` Vector ``
+ [` ->immutable(): ImmVector<\Tv> `](</hack/reference/class/HH.Vector/immutable/>)\
  Returns an immutable copy (`` ImmVector ``) of the current ``` Vector ```
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.Vector/isEmpty/>)\
  Checks if the current `` Vector `` is empty
+ [` ->items(): Rx\Iterable<\Tv> `](</hack/reference/class/HH.Vector/items/>)\
  Returns an `` Iterable `` view of the current ``` Vector ```
+ [` ->keys(): Vector<int> `](</hack/reference/class/HH.Vector/keys/>)\
  Returns a `` Vector `` containing the keys of the current ``` Vector ```
+ [` ->lastKey(): ?int `](</hack/reference/class/HH.Vector/lastKey/>)\
  Returns the last key in the current `` Vector ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.Vector/lastValue/>)\
  Returns the last value in the current `` Vector ``
+ [` ->lazy(): Rx\KeyedIterable<int, \Tv> `](</hack/reference/class/HH.Vector/lazy/>)\
  Returns a lazy, access-elements-only-when-needed view of the current
  `` Vector ``
+ [` ->linearSearch(\mixed $search_value): int `](</hack/reference/class/HH.Vector/linearSearch/>)\
  Returns the index of the first element that matches the search value
+ [` ->map<\Tu>(\callable $callback): Vector<\Tu> `](</hack/reference/class/HH.Vector/map/>)\
  Returns a `` Vector `` containing the results of applying an operation to each
  value in the current ``` Vector ```
+ [` ->mapWithKey<\Tu>(\callable $callback): Vector<\Tu> `](</hack/reference/class/HH.Vector/mapWithKey/>)\
  Returns a `` Vector `` containing the results of applying an operation to each
  key/value pair in the current ``` Vector ```
+ [` ->pop(): \Tv `](</hack/reference/class/HH.Vector/pop/>)\
  Remove the last element of the current `` Vector `` and return it
+ [` ->removeKey(int $key): Vector<\Tv> `](</hack/reference/class/HH.Vector/removeKey/>)\
  Removes the key/value pair with the specified key from the current
  `` Vector ``
+ [` ->reserve(int $sz): \void `](</hack/reference/class/HH.Vector/reserve/>)\
  Reserves enough memory to accommodate a given number of elements
+ [` ->resize(int $sz, \Tv $value): \void `](</hack/reference/class/HH.Vector/resize/>)\
  Resize the current `` Vector ``
+ [` ->reverse(): \void `](</hack/reference/class/HH.Vector/reverse/>)\
  Reverse the elements of the current `` Vector `` in place
+ [` ->set(int $key, \Tv $value): Vector<\Tv> `](</hack/reference/class/HH.Vector/set/>)\
  Stores a value into the current `` Vector `` with the specified key,
  overwriting the previous value associated with the key
+ [` ->setAll(?KeyedTraversable<int, \Tv> $iterable): Vector<\Tv> `](</hack/reference/class/HH.Vector/setAll/>)\
  For every element in the provided `` Traversable ``, stores a value into the
  current ``` Vector ``` associated with each key, overwriting the previous value
  associated with the key
+ [` ->shuffle(): \void `](</hack/reference/class/HH.Vector/shuffle/>)\
  Shuffles the values of the current `` Vector `` randomly in place
+ [` ->skip(int $n): Vector<\Tv> `](</hack/reference/class/HH.Vector/skip/>)\
  Returns a `` Vector `` containing the values after the ``` $n ```-th element of the
  current ```` Vector ````
+ [` ->skipWhile(\callable $fn): Vector<\Tv> `](</hack/reference/class/HH.Vector/skipWhile/>)\
  Returns a `` Vector `` containing the values of the current ``` Vector ``` starting
  after and including the first value that produces ```` false ```` when passed to
  the specified callback
+ [` ->slice(int $start, int $len): Vector<\Tv> `](</hack/reference/class/HH.Vector/slice/>)\
  Returns a subset of the current `` Vector `` starting from a given key up to,
  but not including, the element at the provided length from the starting key
+ [` ->splice(int $offset, ?int $len = NULL): \void `](</hack/reference/class/HH.Vector/splice/>)\
  Splice the current `` Vector `` in place
+ [` ->take(int $n): Vector<\Tv> `](</hack/reference/class/HH.Vector/take/>)\
  Returns a `` Vector `` containing the first ``` $n ``` values of the current
  ```` Vector ````
+ [` ->takeWhile(\callable $callback): Vector<\Tv> `](</hack/reference/class/HH.Vector/takeWhile/>)\
  Returns a `` Vector `` containing the values of the current ``` Vector ``` up to but
  not including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toArray(): array<\Tv> `](</hack/reference/class/HH.Vector/toArray/>)\
  Returns an `` array `` containing the values from the current ``` Vector ```
+ [` ->toDArray(): darray<int, \Tv> `](</hack/reference/class/HH.Vector/toDArray/>)
+ [` ->toImmMap(): ImmMap<int, \Tv> `](</hack/reference/class/HH.Vector/toImmMap/>)\
  Returns an immutable, integer-keyed map (`` ImmMap ``) based on the values of
  the current ``` Vector ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.Vector/toImmSet/>)\
  Returns an immutable set (`` ImmSet ``) based on the values of the current
  ``` Vector ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.Vector/toImmVector/>)\
  Returns an immutable copy (`` ImmVector ``) of the current ``` Vector ```
+ [` ->toKeysArray(): varray<int> `](</hack/reference/class/HH.Vector/toKeysArray/>)\
  Returns an `` array `` whose values are the keys from the current ``` Vector ```
+ [` ->toMap(): Map<int, \Tv> `](</hack/reference/class/HH.Vector/toMap/>)\
  Returns an integer-keyed `` Map `` based on the values of the current ``` Vector ```
+ [` ->toSet(): Set<\Tv> `](</hack/reference/class/HH.Vector/toSet/>)\
  Returns a `` Set `` based on the values of the current ``` Vector ```
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.Vector/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.Vector/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` Vector ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.Vector/toVector/>)\
  Returns a copy of the current `` Vector ``
+ [` ->values(): Vector<\Tv> `](</hack/reference/class/HH.Vector/values/>)\
  Returns a `` Vector `` containing the values of the current ``` Vector ```
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): Vector<\Pair<\Tv, \Tu>> `](</hack/reference/class/HH.Vector/zip/>)\
  Returns a `` Vector `` where each element is a ``` Pair ``` that combines the
  element of the current ```` Vector ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
