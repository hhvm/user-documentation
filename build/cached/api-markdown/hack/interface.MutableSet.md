``` yamlmeta
{
    "name": "MutableSet",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Represents a write-enabled (mutable) set of values, not indexed by keys
(i




e. a set).




## Interface Synopsis




``` Hack
interface MutableSet implements ConstSet, HH\Collection, SetAccess,                                  Collection,                                  SetAccess {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): MutableVector<Tu> `](</hack/reference/interface/MutableSet/concat/>)\
  Returns a `` MutableVector `` that is the concatenation of the values of the
  current ``` MutableSet ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): MutableSet<Tv> `](</hack/reference/interface/MutableSet/filter/>)\
  Returns a `` MutableSet `` containing the values of the current ``` MutableSet ```
  that meet a supplied condition applied to each value
+ [` ->filterWithKey(callable $fn): MutableSet<Tv> `](</hack/reference/interface/MutableSet/filterWithKey/>)\
  Returns a `` MutableSet `` containing the values of the current ``` MutableSet ```
  that meet a supplied condition applied to its "keys" and values
+ [` ->firstKey(): ?arraykey `](</hack/reference/interface/MutableSet/firstKey/>)\
  Returns the first "key" in the current `` MutableSet ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/MutableSet/firstValue/>)\
  Returns the first value in the current `` MutableSet ``
+ [` ->keys(): MutableVector<arraykey> `](</hack/reference/interface/MutableSet/keys/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableSet ```
+ [` ->lastKey(): ?arraykey `](</hack/reference/interface/MutableSet/lastKey/>)\
  Returns the last "key" in the current `` MutableSet ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/MutableSet/lastValue/>)\
  Returns the last value in the current `` MutableSet ``
+ [` ->map<Tu as arraykey>(callable $fn): MutableSet<Tu> `](</hack/reference/interface/MutableSet/map/>)\
  Returns a `` MutableSet `` containing the values after an operation has been
  applied to each value in the current ``` MutableSet ```
+ [` ->mapWithKey<Tu as arraykey>(callable $fn): MutableSet<Tu> `](</hack/reference/interface/MutableSet/mapWithKey/>)\
  Returns a `` MutableSet `` containing the values after an operation has been
  applied to each "key" and value in the current Set
+ [` ->skip(int $n): MutableSet<Tv> `](</hack/reference/interface/MutableSet/skip/>)\
  Returns a `` MutableSet `` containing the values after the ``` n ```-th element of
  the current ```` MutableSet ````
+ [` ->skipWhile(callable $fn): MutableSet<Tv> `](</hack/reference/interface/MutableSet/skipWhile/>)\
  Returns a `` MutableSet `` containing the values of the current ``` MutableSet ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): MutableSet<Tv> `](</hack/reference/interface/MutableSet/slice/>)\
  Returns a subset of the current `` MutableSet `` starting from a given key up
  to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): MutableSet<Tv> `](</hack/reference/interface/MutableSet/take/>)\
  Returns a `` MutableSet `` containing the first ``` n ``` values of the current
  ```` MutableSet ````
+ [` ->takeWhile(callable $fn): MutableSet<Tv> `](</hack/reference/interface/MutableSet/takeWhile/>)\
  Returns a `` MutableSet `` containing the values of the current ``` MutableSet ```
  up to but not including the first value that produces ```` false ```` when passed
  to the specified callback
+ [` ->toDArray(): darray<Tv, Tv> `](</hack/reference/interface/MutableSet/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/MutableSet/toVArray/>)
+ [` ->values(): MutableVector<Tv> `](</hack/reference/interface/MutableSet/values/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableSet ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): /* HH_FIXME[4110] need bottom type as generic */ /* HH_FIXME[4323] */ MutableSet<Pair<Tv, Tu>> `](</hack/reference/interface/MutableSet/zip/>)\
  Returns a `` MutableSet `` where each value is a ``` Pair ``` that combines the
  value of the current ```` MutableSet ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
