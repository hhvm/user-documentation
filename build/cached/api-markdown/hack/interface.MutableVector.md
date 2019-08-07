``` yamlmeta
{
    "name": "MutableVector",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Represents a write-enabled (mutable) sequence of values, indexed by integers
(i




e., a vector).




## Interface Synopsis




``` Hack
interface MutableVector implements ConstVector, HH\Collection, IndexAccess,                                     Collection,                                     IndexAccess {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): MutableVector<Tu> `](</hack/reference/interface/MutableVector/concat/>)\
  Returns a `` MutableVector `` that is the concatenation of the values of the
  current ``` MutableVector ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): MutableVector<Tv> `](</hack/reference/interface/MutableVector/filter/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableVector ``` that meet a supplied condition
+ [` ->filterWithKey(callable $fn): MutableVector<Tv> `](</hack/reference/interface/MutableVector/filterWithKey/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableVector ``` that meet a supplied condition applied to its keys and
  values
+ [` ->firstKey(): ?int `](</hack/reference/interface/MutableVector/firstKey/>)\
  Returns the first key in the current `` MutableVector ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/MutableVector/firstValue/>)\
  Returns the first value in the current `` MutableVector ``
+ [` ->keys(): MutableVector<int> `](</hack/reference/interface/MutableVector/keys/>)\
  Returns a `` MutableVector `` containing the keys of the current
  ``` MutableVector ```
+ [` ->lastKey(): ?int `](</hack/reference/interface/MutableVector/lastKey/>)\
  Returns the last key in the current `` MutableVector ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/MutableVector/lastValue/>)\
  Returns the last value in the current `` MutableVector ``
+ [` ->linearSearch(mixed $search_value): int `](</hack/reference/interface/MutableVector/linearSearch/>)\
  Returns the index of the first element that matches the search value
+ [` ->map<Tu>(callable $fn): MutableVector<Tu> `](</hack/reference/interface/MutableVector/map/>)\
  Returns a `` MutableVector `` containing the values after an operation has been
  applied to each value in the current ``` MutableVector ```
+ [` ->mapWithKey<Tu>(callable $fn): MutableVector<Tu> `](</hack/reference/interface/MutableVector/mapWithKey/>)\
  Returns a `` MutableVector `` containing the values after an operation has been
  applied to each key and value in the current ``` MutableVector ```
+ [` ->skip(int $n): MutableVector<Tv> `](</hack/reference/interface/MutableVector/skip/>)\
  Returns a `` MutableVector `` containing the values after the ``` n ```-th element of
  the current ```` MutableVector ````
+ [` ->skipWhile(callable $fn): MutableVector<Tv> `](</hack/reference/interface/MutableVector/skipWhile/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableVector ``` starting after and including the first value that produces
  ```` true ```` when passed to the specified callback
+ [` ->slice(int $start, int $len): MutableVector<Tv> `](</hack/reference/interface/MutableVector/slice/>)\
  Returns a subset of the current `` MutableVector `` starting from a given key
  up to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): MutableVector<Tv> `](</hack/reference/interface/MutableVector/take/>)\
  Returns a `` MutableVector `` containing the first ``` n ``` values of the current
  ```` MutableVector ````
+ [` ->takeWhile(callable $fn): MutableVector<Tv> `](</hack/reference/interface/MutableVector/takeWhile/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableVector ``` up to but not including the first value that produces
  ```` false ```` when passed to the specified callback
+ [` ->toDArray(): darray<int, Tv> `](</hack/reference/interface/MutableVector/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/MutableVector/toVArray/>)
+ [` ->values(): MutableVector<Tv> `](</hack/reference/interface/MutableVector/values/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableVector ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): MutableVector<Pair<Tv, Tu>> `](</hack/reference/interface/MutableVector/zip/>)\
  Returns a `` MutableVector `` where each element is a ``` Pair ``` that combines the
  element of the current ```` MutableVector ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
