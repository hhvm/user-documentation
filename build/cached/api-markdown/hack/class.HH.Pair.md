``` yamlmeta
{
    "name": "HH\\Pair",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




` Pair ` is a fixed-size collection with exactly two elements (possibly of
different types)




HHVM provides a native implementation for this class.
The PHP class definition below is not actually used at run time; it is
simply provided for the typechecker and for developer reference.




Like all objects in PHP, ` Pair `s have reference-like semantics. The elements
or a `` Pair `` cannot be mutated (i.e. you can assign to the elements of a
``` Pair ```) though ```` Pair ````s may contain mutable objects.




` Pair `s only support integer keys. If a non-integer key is used, an
exception will be thrown.




` Pair `s support `` $m[$k] `` style syntax for getting and setting values by
key. ``` Pair ```s also support ```` isset($m[$k]) ```` and ````` empty($m[$k]) ````` syntax, and
they provide similar semantics as arrays. Elements can be added to a `````` Pair ``````
using ``````` $m[] = .. ``````` syntax.




` Pair `s do not support taking elements by reference. If binding assignment
(`` =& ``) is used with an element of a ``` Pair ```, or if an element of a ```` Pair ```` is
passed by reference, of if a ````` Pair ````` is used with foreach by reference, an
exception will be thrown.




` Pair ` keys are always 0 and 1, repsectively.




You may notice that many methods affecting the instace of ` Pair ` return an
`` ImmVector `` -- ``` Pair ```s are essentially backed by 2-element ```` ImmVector ````s.




## Interface Synopsis




``` Hack
namespace HH;

final class Pair implements \ConstVector {...}
```




### Public Methods




+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.Pair/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.Pair/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.Pair/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.Pair/__toString/>)\
  Returns the `` string `` version of the current ``` Pair ```, which is ```` "Pair" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.Pair/__unset/>)
+ [` ->at(int $key): \mixed `](</hack/reference/class/HH.Pair/at/>)\
  Returns the value at the specified key in the current `` Pair ``
+ [` ->concat<\Tu super mixed>(Traversable<\mixed, \Tu> $traversable): \ ImmVector<\mixed, \Tu> `](</hack/reference/class/HH.Pair/concat/>)\
  Returns an `` ImmVector `` that is the concatenation of the values of the
  current ``` Pair ``` and the values of the provided ```` Traversable ````
+ [` ->containsKey<\Tu super int>(\Tu $key): bool `](</hack/reference/class/HH.Pair/containsKey/>)\
  Checks whether a provided key exists in the current `` Pair ``
+ [` ->count(): int `](</hack/reference/class/HH.Pair/count/>)\
  Returns 2; a `` Pair `` always has two values
+ [` ->filter(\callable $callback): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/filter/>)\
  Returns a `` ImmVector `` containing the values of the current ``` Pair ``` that
  meet a supplied condition
+ [` ->filterWithKey(\callable $callback): \ ImmVector<\mixed> `](</hack/reference/class/HH.Pair/filterWithKey/>)\
  Returns an `` ImmVector `` containing the values of the current ``` Pair ``` that
  meet a supplied condition applied to its keys and values
+ [` ->firstKey(): int `](</hack/reference/class/HH.Pair/firstKey/>)\
  Returns the first key in the current `` Pair ``
+ [` ->firstValue(): \Tv1 `](</hack/reference/class/HH.Pair/firstValue/>)\
  Returns the first value in the current `` Pair ``
+ [` ->get(int $key): \mixed `](</hack/reference/class/HH.Pair/get/>)\
  Returns the value at the specified key in the current `` Pair ``
+ [` ->getIterator(): Rx\KeyedIterator<int, \mixed> `](</hack/reference/class/HH.Pair/getIterator/>)\
  Returns an iterator that points to beginning of the current `` Pair ``
+ [` ->immutable(): \this `](</hack/reference/class/HH.Pair/immutable/>)\
  Returns an immutable version of this collection
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.Pair/isEmpty/>)\
  Returns `` false ``; a ``` Pair ``` cannot be empty
+ [` ->items(): Rx\Iterable<\mixed> `](</hack/reference/class/HH.Pair/items/>)\
  Returns an `` Iterable `` view of the current ``` Pair ```
+ [` ->keys(): ImmVector<int> `](</hack/reference/class/HH.Pair/keys/>)\
  Returns an `` ImmVector `` with the values being the keys of the current
  ``` Pair ```
+ [` ->lastKey(): int `](</hack/reference/class/HH.Pair/lastKey/>)\
  Returns the last key in the current `` Pair ``
+ [` ->lastValue(): \Tv2 `](</hack/reference/class/HH.Pair/lastValue/>)\
  Returns the last value in the current `` Pair ``
+ [` ->lazy(): Rx\KeyedIterable<int, \mixed> `](</hack/reference/class/HH.Pair/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` Pair ``
+ [` ->linearSearch<\Tu super mixed>(\mixed $search_value): int `](</hack/reference/class/HH.Pair/linearSearch/>)\
  Returns the index of the first element that matches the search value
+ [` ->map<\Tu>(\callable $callback): ImmVector<\Tu> `](</hack/reference/class/HH.Pair/map/>)\
  Returns an `` ImmVector `` containing the values after an operation has been
  applied to each value in the current ``` Pair ```
+ [` ->mapWithKey<\Tu>(\callable $callback): \ ImmVector<\Tu> `](</hack/reference/class/HH.Pair/mapWithKey/>)\
  Returns an `` ImmVector `` containing the values after an operation has been
  applied to each key and value in the current ``` Pair ```
+ [` ->skip(int $n): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/skip/>)\
  Returns an `` ImmVector `` containing the values after the ``` n ```-th element of
  the current ```` Pair ````
+ [` ->skipWhile(\callable $callback): \ ImmVector<\mixed> `](</hack/reference/class/HH.Pair/skipWhile/>)\
  Returns an `` ImmVector `` containing the values of the current ``` Pair ``` starting
  after and including the first value that produces ```` true ```` when passed to
  the specified callback
+ [` ->slice(int $start, int $len): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/slice/>)\
  Returns a subset of the current `` Pair `` starting from a given key up to,
  but not including, the element at the provided length from the starting
  key
+ [` ->take(int $n): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/take/>)\
  Returns an `` ImmVector `` containing the first ``` n ``` values of the current
  ```` Pair ````
+ [` ->takeWhile(\callable $callback): \ ImmVector<\mixed> `](</hack/reference/class/HH.Pair/takeWhile/>)\
  Returns an `` ImmVector `` containing the values of the current ``` Pair ``` up to
  but not including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toArray(): array `](</hack/reference/class/HH.Pair/toArray/>)\
  Returns an `` array `` containing the values from the current ``` Pair ```
+ [` ->toDArray(): darray<int, \mixed> `](</hack/reference/class/HH.Pair/toDArray/>)
+ [` ->toImmMap(): ImmMap<int, \mixed> `](</hack/reference/class/HH.Pair/toImmMap/>)\
  Returns an immutable, integer-keyed map (`` ImmMap ``) based on the elements of
  the current ``` Pair ```
+ [` ->toImmSet(): ImmSet<\arraykey, \mixed> `](</hack/reference/class/HH.Pair/toImmSet/>)\
  Returns an immutable set (`` ImmSet ``) with the values of the current ``` Pair ```
+ [` ->toImmVector(): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) containing the elements of the
  current ``` Pair ```
+ [` ->toKeysArray(): varray<int> `](</hack/reference/class/HH.Pair/toKeysArray/>)\
  Returns an `` array `` whose values are the keys from the current ``` Pair ```
+ [` ->toMap(): Map<int, \mixed> `](</hack/reference/class/HH.Pair/toMap/>)\
  Returns an integer-keyed `` Map `` based on the elements of the current ``` Pair ```
+ [` ->toSet(): Set<\arraykey, \mixed> `](</hack/reference/class/HH.Pair/toSet/>)\
  Returns a `` Set `` with the values of the current ``` Pair ```
+ [` ->toVArray(): varray `](</hack/reference/class/HH.Pair/toVArray/>)
+ [` ->toValuesArray<\Tu>(): varray<\Tu> `](</hack/reference/class/HH.Pair/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` Pair ```
+ [` ->toVector(): Vector<\mixed> `](</hack/reference/class/HH.Pair/toVector/>)\
  Returns a `` Vector `` containing the elements of the current ``` Pair ```
+ [` ->values(): ImmVector<\mixed> `](</hack/reference/class/HH.Pair/values/>)\
  Returns an `` ImmVector `` containing the values of the current ``` Pair ```
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): \ ImmVector<\Pair<\mixed, \Tu>, \\HH\Pair<\mixed, \Tu>> `](</hack/reference/class/HH.Pair/zip/>)\
  Returns an `` ImmVector `` where each element is a ``` Pair ``` that combines each
  element of the current ```` Pair ```` and the provided ````` Traversable `````







### Private Methods




* [` ->__construct(): \void `](</hack/reference/class/HH.Pair/__construct/>)
<!-- HHAPIDOC -->
