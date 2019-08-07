``` yamlmeta
{
    "name": "ConstMap",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Represents a read-only (immutable) sequence of key/value pairs, (i




e. a map).




## Interface Synopsis




``` Hack
interface ConstMap implements ConstCollection, ConstMapAccess, HH\Rx\KeyedIterable, HH\KeyedContainer,                                     ConstMapAccess,                                     HH\Rx\KeyedIterable,                                     KeyedContainer {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): ConstVector<Tu> `](</hack/reference/interface/ConstMap/concat/>)\
  Returns a `` ConstVector `` that is the concatenation of the values of the
  current ``` ConstMap ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/filter/>)\
  Returns a `` ConstMap `` containing the values of the current ``` ConstMap ``` that
  meet a supplied condition
+ [` ->filterWithKey(callable $fn): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/filterWithKey/>)\
  Returns a `` ConstMap `` containing the values of the current ``` ConstMap ``` that
  meet a supplied condition applied to its keys and values
+ [` ->firstKey(): ?Tk `](</hack/reference/interface/ConstMap/firstKey/>)\
  Returns the first key in the current `` ConstMap ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/ConstMap/firstValue/>)\
  Returns the first value in the current `` ConstMap ``
+ [` ->keys(): ConstVector<Tk> `](</hack/reference/interface/ConstMap/keys/>)\
  Returns a `` ConstVector `` containing the keys of the current ``` ConstMap ```
+ [` ->lastKey(): ?Tk `](</hack/reference/interface/ConstMap/lastKey/>)\
  Returns the last key in the current `` ConstMap ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/ConstMap/lastValue/>)\
  Returns the last value in the current `` ConstMap ``
+ [` ->map<Tu>(callable $fn): ConstMap<Tk, Tu> `](</hack/reference/interface/ConstMap/map/>)\
  Returns a `` ConstMap `` after an operation has been applied to each value in
  the current ``` ConstMap ```
+ [` ->mapWithKey<Tu>(callable $fn): ConstMap<Tk, Tu> `](</hack/reference/interface/ConstMap/mapWithKey/>)\
  Returns a `` ConstMap `` after an operation has been applied to each key and
  value in the current ``` ConstMap ```
+ [` ->skip(int $n): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/skip/>)\
  Returns a `` ConstMap `` containing the values after the ``` n ```-th element of the
  current ```` ConstMap ````
+ [` ->skipWhile(callable $fn): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/skipWhile/>)\
  Returns a `` ConstMap `` containing the values of the current ``` ConstMap ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/slice/>)\
  Returns a subset of the current `` ConstMap `` starting from a given key
  location up to, but not including, the element at the provided length from
  the starting key location
+ [` ->take(int $n): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/take/>)\
  Returns a `` ConstMap `` containing the first ``` n ``` key/values of the current
  ```` ConstMap ````
+ [` ->takeWhile(callable $fn): ConstMap<Tk, Tv> `](</hack/reference/interface/ConstMap/takeWhile/>)\
  Returns a `` ConstMap `` containing the keys and values of the current
  ``` ConstMap ``` up to but not including the first value that produces ```` false ````
  when passed to the specified callback
+ [` ->toDArray(): darray<Tk, Tv> `](</hack/reference/interface/ConstMap/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/ConstMap/toVArray/>)
+ [` ->values(): ConstVector<Tv> `](</hack/reference/interface/ConstMap/values/>)\
  Returns a `` ConstVector `` containing the values of the current ``` ConstMap ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): ConstMap<Tk, Pair<Tv, Tu>> `](</hack/reference/interface/ConstMap/zip/>)\
  Returns a `` ConstMap `` where each value is a ``` Pair ``` that combines the value
  of the current ```` ConstMap ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
