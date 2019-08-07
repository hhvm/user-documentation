``` yamlmeta
{
    "name": "ConstSet",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Represents a read-only (immutable) set of values, with no keys
(i




e., a set).




## Interface Synopsis




``` Hack
interface ConstSet implements ConstCollection, ConstSetAccess, HH\Rx\KeyedIterable, HH\KeyedContainer,                                 ConstSetAccess,                                 HH\Rx\KeyedIterable,                                 KeyedContainer {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): ConstVector<Tu> `](</hack/reference/interface/ConstSet/concat/>)\
  Returns a `` ConstVector `` that is the concatenation of the values of the
  current ``` ConstSet ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): ConstSet<Tv> `](</hack/reference/interface/ConstSet/filter/>)\
  Returns a `` ConstSet `` containing the values of the current ``` ConstSet ``` that
  meet a supplied condition applied to each value
+ [` ->filterWithKey(callable $fn): ConstSet<Tv> `](</hack/reference/interface/ConstSet/filterWithKey/>)\
  Returns a `` ConstSet `` containing the values of the current ``` ConstSet ``` that
  meet a supplied condition applied to its "keys" and values
+ [` ->firstKey(): ?arraykey `](</hack/reference/interface/ConstSet/firstKey/>)\
  Returns the first "key" in the current `` ConstSet ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/ConstSet/firstValue/>)\
  Returns the first value in the current `` ConstSet ``
+ [` ->keys(): ConstVector<arraykey> `](</hack/reference/interface/ConstSet/keys/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstSet ```
+ [` ->lastKey(): ?arraykey `](</hack/reference/interface/ConstSet/lastKey/>)\
  Returns the last "key" in the current `` ConstSet ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/ConstSet/lastValue/>)\
  Returns the last value in the current `` ConstSet ``
+ [` ->map<Tu as arraykey>(callable $fn): ConstSet<Tu> `](</hack/reference/interface/ConstSet/map/>)\
  Returns a `` ConstSet `` containing the values after an operation has been
  applied to each value in the current ``` ConstSet ```
+ [` ->mapWithKey<Tu as arraykey>(callable $fn): ConstSet<Tu> `](</hack/reference/interface/ConstSet/mapWithKey/>)\
  Returns a `` ConstSet `` containing the values after an operation has been
  applied to each "key" and value in the current Set
+ [` ->skip(int $n): ConstSet<Tv> `](</hack/reference/interface/ConstSet/skip/>)\
  Returns a `` ConstSet `` containing the values after the ``` n ```-th element of the
  current ```` ConstSet ````
+ [` ->skipWhile(callable $fn): ConstSet<Tv> `](</hack/reference/interface/ConstSet/skipWhile/>)\
  Returns a `` ConstSet `` containing the values of the current ``` ConstSet ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): ConstSet<Tv> `](</hack/reference/interface/ConstSet/slice/>)\
  Returns a subset of the current `` ConstSet `` starting from a given key up
  to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): ConstSet<Tv> `](</hack/reference/interface/ConstSet/take/>)\
  Returns a `` ConstSet `` containing the first ``` n ``` values of the current
  ```` ConstSet ````
+ [` ->takeWhile(callable $fn): ConstSet<Tv> `](</hack/reference/interface/ConstSet/takeWhile/>)\
  Returns a `` ConstSet `` containing the values of the current ``` ConstSet ``` up to
  but not including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toDArray(): darray<Tv, Tv> `](</hack/reference/interface/ConstSet/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/ConstSet/toVArray/>)
+ [` ->values(): ConstVector<Tv> `](</hack/reference/interface/ConstSet/values/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstSet ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): ConstSet<Pair<Tv, Tu>> `](</hack/reference/interface/ConstSet/zip/>)\
  Returns a `` ConstSet `` where each value is a ``` Pair ``` that combines the value
  of the current ```` ConstSet ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
