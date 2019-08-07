``` yamlmeta
{
    "name": "MutableMap",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Represents a write-enabled (mutable) sequence of key/value pairs
(i




e. a map).




## Interface Synopsis




``` Hack
interface MutableMap implements ConstMap, HH\Collection, MapAccess,                                      Collection,                                      MapAccess {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): MutableVector<Tu> `](</hack/reference/interface/MutableMap/concat/>)\
  Returns a `` MutableVector `` that is the concatenation of the values of the
  current ``` MutableMap ``` and the values of the provided ```` Traversable ````
+ [` ->filter(callable $fn): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/filter/>)\
  Returns a `` MutableMap `` containing the values of the current ``` MutableMap ```
  that meet a supplied condition
+ [` ->filterWithKey(callable $fn): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/filterWithKey/>)\
  Returns a `` MutableMap `` containing the values of the current ``` MutableMap ```
  that meet a supplied condition applied to its keys and values
+ [` ->firstKey(): ?Tk `](</hack/reference/interface/MutableMap/firstKey/>)\
  Returns the first key in the current `` MutableMap ``
+ [` ->firstValue(): ?Tv `](</hack/reference/interface/MutableMap/firstValue/>)\
  Returns the first value in the current `` MutableMap ``
+ [` ->keys(): MutableVector<Tk> `](</hack/reference/interface/MutableMap/keys/>)\
  Returns a `` MutableVector `` containing the keys of the current ``` MutableMap ```
+ [` ->lastKey(): ?Tk `](</hack/reference/interface/MutableMap/lastKey/>)\
  Returns the last key in the current `` MutableMap ``
+ [` ->lastValue(): ?Tv `](</hack/reference/interface/MutableMap/lastValue/>)\
  Returns the last value in the current `` MutableMap ``
+ [` ->map<Tu>(callable $fn): MutableMap<Tk, Tu> `](</hack/reference/interface/MutableMap/map/>)\
  Returns a `` MutableMap `` after an operation has been applied to each value
  in the current ``` MutableMap ```
+ [` ->mapWithKey<Tu>(callable $fn): MutableMap<Tk, Tu> `](</hack/reference/interface/MutableMap/mapWithKey/>)\
  Returns a `` MutableMap `` after an operation has been applied to each key and
  value in the current ``` MutableMap ```
+ [` ->skip(int $n): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/skip/>)\
  Returns a `` MutableMap `` containing the values after the ``` n ```-th element of
  the current ```` MutableMap ````
+ [` ->skipWhile(callable $fn): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/skipWhile/>)\
  Returns a `` MutableMap `` containing the values of the current ``` MutableMap ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/slice/>)\
  Returns a subset of the current `` MutableMap `` starting from a given key
  location up to, but not including, the element at the provided length from
  the starting key location
+ [` ->take(int $n): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/take/>)\
  Returns a `` MutableMap `` containing the first ``` n ``` key/values of the current
  ```` MutableMap ````
+ [` ->takeWhile(callable $fn): MutableMap<Tk, Tv> `](</hack/reference/interface/MutableMap/takeWhile/>)\
  Returns a `` MutableMap `` containing the keys and values of the current
  ``` MutableMap ``` up to but not including the first value that produces ```` false ````
  when passed to the specified callback
+ [` ->toDArray(): darray<Tk, Tv> `](</hack/reference/interface/MutableMap/toDArray/>)
+ [` ->toVArray(): varray<Tv> `](</hack/reference/interface/MutableMap/toVArray/>)
+ [` ->values(): MutableVector<Tv> `](</hack/reference/interface/MutableMap/values/>)\
  Returns a `` MutableVector `` containing the values of the current
  ``` MutableMap ```
+ [` ->zip<Tu>(Traversable<Tu> $traversable): MutableMap<Tk, Pair<Tv, Tu>> `](</hack/reference/interface/MutableMap/zip/>)\
  Returns a `` MutableMap `` where each value is a ``` Pair ``` that combines the
  value of the current ```` MutableMap ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
