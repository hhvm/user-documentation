``` yamlmeta
{
    "name": "HH\\Map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




` Map ` is an ordered dictionary-style collection




HHVM provides a native
implementation for this class. The PHP class definition below is not
actually used at run time; it is simply provided for the typechecker and for
developer reference.




Like all objects in PHP, ` Map `s have reference-like semantics. When a caller
passes a `` Map `` to a callee, the callee can modify the ``` Map ``` and the caller
will see the changes. ```` Map ````s do not have "copy-on-write" semantics.




` Map `s preserve insertion order of key/value pairs. When iterating over a
`` Map ``, the key/value pairs appear in the order they were inserted. Also,
``` Map ```s do not automagically convert integer-like ```` string ```` keys (ex. ````` "123" `````)
into integer keys.




` Map `s only support `` int `` keys and ``` string ``` keys. If a key of a different
type is used, an exception will be thrown.




` Map `s support `` $m[$k] `` style syntax for getting and setting values by key.
``` Map ```s also support ```` isset($m[$k]) ```` and ````` empty($m[$k]) ````` syntax, and they
provide similar semantics as arrays. Adding an element with square bracket
syntax `````` [] `````` is supported either by providing a key between the brackets or
a ``````` Pair ``````` on the right-hand side. e.g.,
```````` $m[$k] = $v ```````` is supported
````````` $m[] = Pair {$k, $v} ````````` is supported
`````````` $m[] = $v `````````` is not supported.




` Map `s do not support iterating while new keys are being added or elements
are being removed. When a new key is added or an element is removed, all
iterators that point to the `` Map `` shall be considered invalid.




` Map `s do not support taking elements by reference. If binding assignment
(`` =& ``) is used with an element of a ``` Map ```, or if an element of a ```` Map ```` is
passed by reference, of if a ````` Map ````` is used with `````` foreach `````` by reference, an
exception will be thrown.




## Interface Synopsis




``` Hack
namespace HH;

final class Map implements \MutableMap {...}
```




### Public Methods




+ [` ::fromArray(\darray<\Tk, \Tv> $arr): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/fromArray/>)\
  Returns a `` Map `` containing the key/value pairs from the specified ``` array ```
+ [` ::fromItems(?Traversable<\Pair<\Tk, \Tv>> $iterable): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/fromItems/>)\
  Creates a `` Map `` from the given ``` Traversable ```, or an empty ```` Map ```` if
  ````` null ````` is passed
+ [` ->__construct(?KeyedTraversable<\Tk, \Tv> $iterable = NULL): \void `](</hack/reference/class/HH.Map/__construct/>)\
  Creates a `` Map `` from the given ``` KeyedTraversable ```, or an empty ```` Map ```` if
  ````` null ````` is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.Map/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.Map/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.Map/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.Map/__toString/>)\
  Returns the `` string `` version of the current ``` Map ```, which is ```` "Map" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.Map/__unset/>)
+ [` ->add(\Pair<\Tk, \Tv> $val): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/add/>)\
  Add a key/value pair to the end of the current `` Map ``
+ [` ->addAll(?Traversable<\Pair<\Tk, \Tv>> $iterable): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/addAll/>)\
  For every element in the provided `` Traversable ``, add a key/value pair into
  the current ``` Map ```
+ [` ->at(\Tk $key): \Tv `](</hack/reference/class/HH.Map/at/>)\
  Returns the value at the specified key in the current `` Map ``
+ [` ->clear(): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/clear/>)\
  Remove all the elements from the current `` Map ``
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): Vector<\Tu> `](</hack/reference/class/HH.Map/concat/>)\
  Returns a `` Vector `` that is the concatenation of the values of the current
  ``` Map ``` and the values of the provided ```` Traversable ````
+ [` ->contains(\mixed $key): bool `](</hack/reference/class/HH.Map/contains/>)\
  Determines if the specified key is in the current `` Map ``
+ [` ->containsKey(\mixed $key): bool `](</hack/reference/class/HH.Map/containsKey/>)\
  Determines if the specified key is in the current `` Map ``
+ [` ->count(): int `](</hack/reference/class/HH.Map/count/>)\
  Provides the number of elements in the current `` Map ``
+ [` ->differenceByKey(KeyedTraversable<\Tk, \Tv> $traversable): \ Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/differenceByKey/>)\
  Returns a new `` Map `` with the keys that are in the current ``` Map ```, but not
  in the provided ```` KeyedTraversable ````
+ [` ->filter(\callable $callback): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/filter/>)\
  Returns a `` Map `` containing the values of the current ``` Map ``` that meet
  a supplied condition
+ [` ->filterWithKey(\callable $callback): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/filterWithKey/>)\
  Returns a `` Map `` containing the values of the current ``` Map ``` that meet
  a supplied condition applied to its keys and values
+ [` ->firstKey(): ?\Tk `](</hack/reference/class/HH.Map/firstKey/>)\
  Returns the first key in the current `` Map ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.Map/firstValue/>)\
  Returns the first value in the current `` Map ``
+ [` ->get(\Tk $key): ?\Tv `](</hack/reference/class/HH.Map/get/>)\
  Returns the value at the specified key in the current `` Map ``
+ [` ->getIterator(): Rx\KeyedIterator<\Tk, \Tv> `](</hack/reference/class/HH.Map/getIterator/>)\
  Returns an iterator that points to beginning of the current `` Map ``
+ [` ->immutable(): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.Map/immutable/>)\
  Returns a deep, immutable copy (`` ImmMap ``) of this ``` Map ```
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.Map/isEmpty/>)\
  Checks if the current `` Map `` is empty
+ [` ->items(): Rx\Iterable<\Pair<\Tk, \Tv>> `](</hack/reference/class/HH.Map/items/>)\
  Returns an `` Iterable `` view of the current ``` Map ```
+ [` ->keys(): Vector<\Tk> `](</hack/reference/class/HH.Map/keys/>)\
  Returns a `` Vector `` containing the keys of the current ``` Map ```
+ [` ->lastKey(): ?\Tk `](</hack/reference/class/HH.Map/lastKey/>)\
  Returns the last key in the current `` Map ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.Map/lastValue/>)\
  Returns the last value in the current `` Map ``
+ [` ->lazy(): Rx\KeyedIterable<\Tk, \Tv> `](</hack/reference/class/HH.Map/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` Map ``
+ [` ->map<\Tu>(\callable $callback): Map<\Tk, \Tu> `](</hack/reference/class/HH.Map/map/>)\
  Returns a `` Map `` after an operation has been applied to each value in the
  current ``` Map ```
+ [` ->mapWithKey<\Tu>(\callable $callback): Map<\Tk, \Tu> `](</hack/reference/class/HH.Map/mapWithKey/>)\
  Returns a `` Map `` after an operation has been applied to each key and
  value in the current ``` Map ```
+ [` ->remove(\Tk $key): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/remove/>)\
  Removes the specified key (and associated value) from the current `` Map ``
+ [` ->removeKey(\Tk $key): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/removeKey/>)\
  Removes the specified key (and associated value) from the current `` Map ``
+ [` ->reserve(int $sz): \void `](</hack/reference/class/HH.Map/reserve/>)\
  Reserves enough memory to accommodate a given number of elements
+ [` ->retain(\mixed $callback): object `](</hack/reference/class/HH.Map/retain/>)
+ [` ->retainWithKey(\mixed $callback): object `](</hack/reference/class/HH.Map/retainWithKey/>)
+ [` ->set(\Tk $key, \Tv $value): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/set/>)\
  Stores a value into the current `` Map `` with the specified key, overwriting
  the previous value associated with the key
+ [` ->setAll(?KeyedTraversable<\Tk, \Tv> $iterable): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/setAll/>)\
  For every element in the provided `` Traversable ``, stores a value into the
  current ``` Map ``` associated with each key, overwriting the previous value
  associated with the key
+ [` ->skip(int $n): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/skip/>)\
  Returns a `` Map `` containing the values after the ``` n ```-th element of the
  current ```` Map ````
+ [` ->skipWhile(\callable $fn): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/skipWhile/>)\
  Returns a `` Map `` containing the values of the current ``` Map ``` starting after
  and including the first value that produces ```` true ```` when passed to the
  specified callback
+ [` ->slice(int $start, int $len): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/slice/>)\
  Returns a subset of the current `` Map `` starting from a given key location
  up to, but not including, the element at the provided length from the
  starting key location
+ [` ->take(int $n): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/take/>)\
  Returns a `` Map `` containing the first ``` n ``` key/values of the current ```` Map ````
+ [` ->takeWhile(\callable $callback): Map<\Tk, \Tv> `](</hack/reference/class/HH.Map/takeWhile/>)\
  Returns a `` Map `` containing the keys and values of the current ``` Map ``` up to
  but not including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toArray(): array<\Tk, \Tv> `](</hack/reference/class/HH.Map/toArray/>)\
  Returns an `` array `` containing the key/value pairs from the current ``` Map ```
+ [` ->toDArray(): darray<\Tk, \Tv> `](</hack/reference/class/HH.Map/toDArray/>)
+ [` ->toImmMap(): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.Map/toImmMap/>)\
  Returns a deep, immutable copy (`` ImmMap ``) of the current ``` Map ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.Map/toImmSet/>)\
  Returns an immutable set (`` ImmSet ``) based on the values of the current
  ``` Map ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.Map/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) with the values of the current
  ``` Map ```
+ [` ->toKeysArray(): varray<\Tk> `](</hack/reference/class/HH.Map/toKeysArray/>)\
  Returns an `` array `` whose values are the keys of the current ``` Map ```
+ [` ->toMap(): \this<\Tk, \Tv> `](</hack/reference/class/HH.Map/toMap/>)\
  Returns a deep copy of the current `` Map ``
+ [` ->toSet(): Set<\Tv> `](</hack/reference/class/HH.Map/toSet/>)\
  Returns a `` Set `` based on the values of the current ``` Map ```
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.Map/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.Map/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` Map ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.Map/toVector/>)\
  Returns a `` Vector `` with the values of the current ``` Map ```
+ [` ->values(): Vector<\Tv> `](</hack/reference/class/HH.Map/values/>)\
  Returns a `` Vector `` containing the values of the current ``` Map ```
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): Map<\Tk, \Pair<\Tv, \Tu>> `](</hack/reference/class/HH.Map/zip/>)\
  Returns a `` Map `` where each value is a ``` Pair ``` that combines the value
  of the current ```` Map ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
