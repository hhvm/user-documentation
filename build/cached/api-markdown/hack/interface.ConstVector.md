``` yamlmeta
{
    "name": "ConstVector",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Represents a read-only (immutable) sequence of values, indexed by integers
(i




e., a vector).




## Interface Synopsis




``` Hack
interface ConstVector implements ConstCollection, ConstIndexAccess, HH\Rx\KeyedIterable, HH\KeyedContainer,                                    ConstIndexAccess,                                    HH\Rx\KeyedIterable,                                    KeyedContainer {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): ConstVector<Tu> `](</hack/reference/interface/ConstVector/concat/>)\
  Returns a `` ConstVector `` that is the concatenation of the values of the
  current ``` ConstVector ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): ConstVector<Tv> `](</hack/reference/interface/ConstVector/filter/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstVector ```
  that meet a supplied condition
+ [` ->filterWithKey(callable $fn): ConstVector<Tv> `](</hack/reference/interface/ConstVector/filterWithKey/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstVector ```
  that meet a supplied condition applied to its keys and values
+ [` ->firstKey(): ?int `](</hack/reference/interface/ConstVector/firstKey/>)\
  Returns the first key in the current `` ConstVector ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/ConstVector/firstValue/>)\
  Returns the first value in the current `` ConstVector ``
+ [` ->keys(): ConstVector<int> `](</hack/reference/interface/ConstVector/keys/>)\
  Returns a `` ConstVector `` containing the keys of the current ``` ConstVector ```
+ [` ->lastKey(): ?int `](</hack/reference/interface/ConstVector/lastKey/>)\
  Returns the last key in the current `` ConstVector ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/ConstVector/lastValue/>)\
  Returns the last value in the current `` ConstVector ``
+ [` ->linearSearch(mixed $search_value): int `](</hack/reference/interface/ConstVector/linearSearch/>)\
  Returns the index of the first element that matches the search value
+ [` ->map<Tu>(callable $fn): ConstVector<Tu> `](</hack/reference/interface/ConstVector/map/>)\
  Returns a `` ConstVector `` containing the values after an operation has been
  applied to each value in the current ``` ConstVector ```
+ [` ->mapWithKey<Tu>(callable $fn): ConstVector<Tu> `](</hack/reference/interface/ConstVector/mapWithKey/>)\
  Returns a `` ConstVector `` containing the values after an operation has been
  applied to each key and value in the current ``` ConstVector ```
+ [` ->skip(int $n): ConstVector<Tv> `](</hack/reference/interface/ConstVector/skip/>)\
  Returns a `` ConstVector `` containing the values after the ``` n ```-th element of
  the current ```` ConstVector ````
+ [` ->skipWhile(callable $fn): ConstVector<Tv> `](</hack/reference/interface/ConstVector/skipWhile/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstVector ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): ConstVector<Tv> `](</hack/reference/interface/ConstVector/slice/>)\
  Returns a subset of the current `` ConstVector `` starting from a given key up
  to, but not including, the element at the provided length from the starting
  key
+ [` ->take(int $n): ConstVector<Tv> `](</hack/reference/interface/ConstVector/take/>)\
  Returns a `` ConstVector `` containing the first ``` n ``` values of the current
  ```` ConstVector ````
+ [` ->takeWhile(callable $fn): ConstVector<Tv> `](</hack/reference/interface/ConstVector/takeWhile/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstVector ```
  up to but not including the first value that produces ```` false ```` when passed
  to the specified callback
+ [` ->toDArray(): darray<int, Tv> `](</hack/reference/interface/ConstVector/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/ConstVector/toVArray/>)
+ [` ->values(): ConstVector<Tv> `](</hack/reference/interface/ConstVector/values/>)\
  Returns a `` ConstVector `` containing the values of the current
  ``` ConstVector ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): ConstVector<Pair<Tv, Tu>> `](</hack/reference/interface/ConstVector/zip/>)\
  Returns a `` ConstVector `` where each element is a ``` Pair ``` that combines the
  element of the current ```` ConstVector ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
