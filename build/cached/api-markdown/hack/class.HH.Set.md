``` yamlmeta
{
    "name": "HH\\Set",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




` Set ` is an ordered set-style collection




HHVM provides a native
implementation for this class. The PHP class definition below is not
actually used at run time; it is simply provided for the typechecker and
for developer reference.




Like all objects in PHP, ` Set `s have reference-like semantics. When a caller
passes a `` Set `` to a callee, the callee can modify the ``` Set ``` and the caller
will see the changes. ```` Set ````s do not have "copy-on-write" semantics.




` Set `s preserve insertion order of the elements. When iterating over a
`` Set ``, the elements appear in the order they were inserted. Also, ``` Set ```s do
not automagically convert integer-like strings (ex. "123") into integers.




` Set `s only support `` int `` values and ``` string ``` values. If a value of a
different type is used, an exception will be thrown.




In general, Sets do not support ` $c[$k] ` style syntax. Adding an element
using `` $c[] = .. `` syntax is supported.




` Set ` do not support iteration while elements are being added or removed.
When an element is added or removed, all iterators that point to the `` Set ``
shall be considered invalid.




` Set `s do not support taking elements by reference. If binding assignment
(`` =& ``) is used when adding a new element to a ``` Set ``` (ex. ```` $c[] =& ... ````), or
if a ````` Set ````` is used with `````` foreach `````` by reference, an exception will be thrown.




## Interface Synopsis




``` Hack
namespace HH;

final class Set implements \MutableSet {...}
```




### Public Methods




+ [` ::fromArray(\darray<\arraykey, \Tv> $arr): Set<\Tv> `](</hack/reference/class/HH.Set/fromArray/>)\
  Returns a `` Set `` containing the values from the specified ``` array ```
+ [` ::fromArrays(...$argv): Set<\Tv> `](</hack/reference/class/HH.Set/fromArrays/>)\
  Returns a `` Set `` containing all the values from the specified ``` array ```(s)
+ [` ::fromItems(?Traversable<\Tv> $iterable): Set<\Tv> `](</hack/reference/class/HH.Set/fromItems/>)\
  Creates a `` Set `` from the given ``` Traversable ```, or an empty ```` Set ```` if ````` null `````
  is passed
+ [` ::fromKeysOf<\Tk as arraykey>(?KeyedContainer<\Tk, \mixed> $container): Set<\Tk> `](</hack/reference/class/HH.Set/fromKeysOf/>)\
  Creates a `` Set `` from the keys of the specified container
+ [` ->__construct(?Traversable<\Tv> $iterable = NULL): \void `](</hack/reference/class/HH.Set/__construct/>)\
  Creates a `` Set `` from the given ``` Traversable ```, or an empty ```` Set ```` if ````` null `````
  is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.Set/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.Set/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.Set/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.Set/__toString/>)\
  Returns the `` string `` version of the current ``` Set ```, which is ```` "Set" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.Set/__unset/>)
+ [` ->add(\Tv $val): Set<\Tv> `](</hack/reference/class/HH.Set/add/>)\
  Add the value to the current `` Set ``
+ [` ->addAll(?Traversable<\Tv> $iterable): Set<\Tv> `](</hack/reference/class/HH.Set/addAll/>)\
  For every element in the provided `` Traversable ``, add the value into the
  current ``` Set ```
+ [` ->addAllKeysOf(?KeyedContainer<\Tv, \mixed> $container): Set<\Tv> `](</hack/reference/class/HH.Set/addAllKeysOf/>)\
  Adds the keys of the specified container to the current `` Set `` as new
  values
+ [` ->clear(): Set<\Tv> `](</hack/reference/class/HH.Set/clear/>)\
  Remove all the elements from the current `` Set ``
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): Vector<\Tu> `](</hack/reference/class/HH.Set/concat/>)\
  Returns a `` Vector `` that is the concatenation of the values of the current
  ``` Set ``` and the values of the provided ```` Traversable ````
+ [` ->contains(\mixed $val): bool `](</hack/reference/class/HH.Set/contains/>)\
  Determines if the specified value is in the current `` Set ``
+ [` ->count(): int `](</hack/reference/class/HH.Set/count/>)\
  Provides the number of elements in the current `` Set ``
+ [` ->difference(\mixed $iterable) `](</hack/reference/class/HH.Set/difference/>)
+ [` ->filter(\callable $callback): Set<\Tv> `](</hack/reference/class/HH.Set/filter/>)\
  Returns a `` Set `` containing the values of the current ``` Set ``` that meet
  a supplied condition applied to each value
+ [` ->filterWithKey(\callable $callback): Set<\Tv> `](</hack/reference/class/HH.Set/filterWithKey/>)\
  Returns a `` Set `` containing the values of the current ``` Set ``` that meet
  a supplied condition applied to its "keys" and values
+ [` ->firstKey(): ?\arraykey `](</hack/reference/class/HH.Set/firstKey/>)\
  Returns the first "key" in the current `` Set ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.Set/firstValue/>)\
  Returns the first value in the current `` Set ``
+ [` ->getIterator(): Rx\KeyedIterator<\arraykey, \Tv> `](</hack/reference/class/HH.Set/getIterator/>)\
  Returns an iterator that points to beginning of the current `` Set ``
+ [` ->immutable(): ImmSet<\Tv> `](</hack/reference/class/HH.Set/immutable/>)\
  Returns an immutable (`` ImmSet ``), deep copy of the current ``` Set ```
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.Set/isEmpty/>)\
  Checks if the current `` Set `` is empty
+ [` ->items(): Rx\Iterable<\Tv> `](</hack/reference/class/HH.Set/items/>)\
  Returns an `` Iterable `` view of the current ``` Set ```
+ [` ->keys(): Vector<\arraykey> `](</hack/reference/class/HH.Set/keys/>)\
  Returns a `` Vector `` containing the values of the current ``` Set ```
+ [` ->lastKey(): ?\arraykey `](</hack/reference/class/HH.Set/lastKey/>)\
  Returns the last "key" in the current `` Set ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.Set/lastValue/>)\
  Returns the last value in the current `` Set ``
+ [` ->lazy(): Rx\KeyedIterable<\arraykey, \Tv> `](</hack/reference/class/HH.Set/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` Set ``
+ [` ->map<\Tu as arraykey>(\callable $callback): Set<\Tu> `](</hack/reference/class/HH.Set/map/>)\
  Returns a `` Set `` containing the values after an operation has been applied
  to each value in the current ``` Set ```
+ [` ->mapWithKey<\Tu as arraykey>(\callable $callback): Set<\Tu> `](</hack/reference/class/HH.Set/mapWithKey/>)\
  Returns a `` Set `` containing the values after an operation has been applied
  to each "key" and value in the current ``` Set ```
+ [` ->remove(\Tv $val): Set<\Tv> `](</hack/reference/class/HH.Set/remove/>)\
  Removes the specified value from the current `` Set ``
+ [` ->removeAll(Traversable<\Tv> $iterable): Set<\Tv> `](</hack/reference/class/HH.Set/removeAll/>)\
  Removes the values in the current `` Set `` that are also in the ``` Traversable ```
+ [` ->reserve(int $sz): \void `](</hack/reference/class/HH.Set/reserve/>)\
  Reserves enough memory to accommodate a given number of elements
+ [` ->retain(\callable $callback): Set<\Tv> `](</hack/reference/class/HH.Set/retain/>)\
  Alters the current `` Set `` so that it only contains the values that meet a
  supplied condition on each value
+ [` ->retainWithKey(\callable $callback): Set<\Tv> `](</hack/reference/class/HH.Set/retainWithKey/>)\
  Alters the current `` Set `` so that it only contains the values that meet a
  supplied condition on its "keys" and values
+ [` ->skip(int $n): Set<\Tv> `](</hack/reference/class/HH.Set/skip/>)\
  Returns a `` Set `` containing the values after the ``` n ```-th element of the
  current ```` Set ````
+ [` ->skipWhile(\callable $fn): Set<\Tv> `](</hack/reference/class/HH.Set/skipWhile/>)\
  Returns a `` Set `` containing the values of the current ``` Set ``` starting after
  and including the first value that produces ```` true ```` when passed to the
  specified callback
+ [` ->slice(int $start, int $len): Set<\Tv> `](</hack/reference/class/HH.Set/slice/>)\
  Returns a subset of the current `` Set `` starting from a given key up to, but
  not including, the element at the provided length from the starting key
+ [` ->take(int $n): Set<\Tv> `](</hack/reference/class/HH.Set/take/>)\
  Returns a `` Set `` containing the first ``` n ``` values of the current ```` Set ````
+ [` ->takeWhile(\callable $callback): Set<\Tv> `](</hack/reference/class/HH.Set/takeWhile/>)\
  Returns a `` Set `` containing the values of the current ``` Set ``` up to but not
  including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toArray(): array<\arraykey, \Tv> `](</hack/reference/class/HH.Set/toArray/>)\
  Returns an `` array `` containing the values from the current ``` Set ```
+ [` ->toDArray(): darray<\Tv, \Tv> `](</hack/reference/class/HH.Set/toDArray/>)
+ [` ->toImmMap(): ImmMap<\arraykey, \Tv> `](</hack/reference/class/HH.Set/toImmMap/>)\
  Returns an immutable map (`` ImmMap ``) based on the values of the current
  ``` Set ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.Set/toImmSet/>)\
  Returns an immutable (`` ImmSet ``), deep copy of the current ``` Set ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.Set/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) with the values of the current
  ``` Set ```
+ [` ->toKeysArray(): varray<\Tv> `](</hack/reference/class/HH.Set/toKeysArray/>)\
  Returns an `` array `` containing the values from the current ``` Set ```
+ [` ->toMap(): Map<\arraykey, \Tv> `](</hack/reference/class/HH.Set/toMap/>)\
  Returns a `` Map `` based on the values of the current ``` Set ```
+ [` ->toSet(): \this<\Tv> `](</hack/reference/class/HH.Set/toSet/>)\
  Returns a deep copy of the current `` Set ``
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.Set/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.Set/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` Set ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.Set/toVector/>)\
  Returns a `` Vector `` of the current ``` Set ``` values
+ [` ->values(): Vector<\Tv> `](</hack/reference/class/HH.Set/values/>)\
  Returns a `` Vector `` containing the values of the current ``` Set ```
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): Set<\Pair<\Tv, \Tu>> `](</hack/reference/class/HH.Set/zip/>)\
  Throws an exception unless the current `` Set `` or the ``` Traversable ``` is
  empty
<!-- HHAPIDOC -->
