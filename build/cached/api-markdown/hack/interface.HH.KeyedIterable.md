``` yamlmeta
{
    "name": "HH\\KeyedIterable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Represents any entity that can be iterated over using something like
` foreach `




The entity is required to have a key in addition to values.




` KeyedIterable ` does not include `` array ``s.




## Interface Synopsis




``` Hack
namespace HH;

interface KeyedIterable implements Iterable, KeyedTraversable {...}
```




### Public Methods




+ [` ->concat<\Tu super Tv>(\ Traversable<\Tu> $traversable): Iterable<\Tu> `](</hack/reference/interface/HH.KeyedIterable/concat/>)\
  Returns an `` Iterable `` that is the concatenation of the values of the
  current ``` KeyedIterable ``` and the values of the provided ```` Traversable ````
+ [` ->filter(\callable $fn): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/filter/>)\
  Returns a `` KeyedIterable `` containing the values of the current
  ``` KeyedIterable ``` that meet a supplied condition
+ [` ->filterWithKey(\callable $callback): \ KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/filterWithKey/>)\
  Returns a `` KeyedIterable `` containing the values of the current
  ``` KeyedIterable ``` that meet a supplied condition applied to its keys and
  values
+ [` ->firstKey(): ?\Tk `](</hack/reference/interface/HH.KeyedIterable/firstKey/>)\
  Returns the first key in the current `` KeyedIterable ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/interface/HH.KeyedIterable/firstValue/>)\
  Returns the first value in the current `` KeyedIterable ``
+ [` ->getIterator(): KeyedIterator<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/getIterator/>)\
  Returns an iterator that points to beginning of the current
  `` KeyedIterable ``
+ [` ->keys(): Iterable<\Tk> `](</hack/reference/interface/HH.KeyedIterable/keys/>)\
  Returns an `` Iterable `` containing the current ``` KeyedIterable ```'s keys
+ [` ->lastKey(): ?\Tk `](</hack/reference/interface/HH.KeyedIterable/lastKey/>)\
  Returns the last key in the current `` KeyedIterable ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/interface/HH.KeyedIterable/lastValue/>)\
  Returns the last value in the current `` KeyedIterable ``
+ [` ->lazy(): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` KeyedIterable ``
+ [` ->map<\Tu>(\callable $fn): KeyedIterable<\Tk, \Tu> `](</hack/reference/interface/HH.KeyedIterable/map/>)\
  Returns a `` KeyedIterable `` containing the values after an operation has been
  applied to each value in the current ``` KeyedIterable ```
+ [` ->mapWithKey<\Tu>(\callable $callback): \ KeyedIterable<\Tk, \Tu> `](</hack/reference/interface/HH.KeyedIterable/mapWithKey/>)\
  Returns a `` KeyedIterable `` containing the values after an operation has
  been applied to each key and value in the current ``` KeyedIterable ```
+ [` ->skip(int $n): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/skip/>)\
  Returns a `` KeyedIterable `` containing the values after the ``` n ```-th element
  of the current ```` KeyedIterable ````
+ [` ->skipWhile(\callable $fn): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/skipWhile/>)\
  Returns a `` KeyedIterable `` containing the values of the current
  ``` KeyedIterable ``` starting after and including the first value that produces
  ```` true ```` when passed to the specified callback
+ [` ->slice(int $start, int $len): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/slice/>)\
  Returns a subset of the current `` KeyedIterable `` starting from a given key
  up to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/take/>)\
  Returns a `` KeyedIterable `` containing the first ``` n ``` values of the current
  ```` KeyedIterable ````
+ [` ->takeWhile(\callable $fn): KeyedIterable<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/takeWhile/>)\
  Returns a `` KeyedIterable `` containing the values of the current
  ``` KeyedIterable ``` up to but not including the first value that produces
  ```` false ```` when passed to the specified callback
+ [` ->toImmMap(): ImmMap<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/toImmMap/>)\
  Returns an immutable map (`` ImmMap ``) based on the keys and values of the
  current ``` KeyedIterable ```
+ [` ->toKeysArray(): \varray `](</hack/reference/interface/HH.KeyedIterable/toKeysArray/>)\
  Returns an `` array `` with the keys from the current ``` KeyedIterable ```
+ [` ->toMap(): Map<\Tk, \Tv> `](</hack/reference/interface/HH.KeyedIterable/toMap/>)\
  Returns a `` Map `` based on the keys and values of the current
  ``` KeyedIterable ```
+ [` ->values(): Iterable<\Tv> `](</hack/reference/interface/HH.KeyedIterable/values/>)\
  Returns an `` Iterable `` containing the current ``` KeyedIterable ```'s values
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): \ KeyedIterable<\Tk, \Pair<\Tv, \Tu>> `](</hack/reference/interface/HH.KeyedIterable/zip/>)\
  Returns a `` KeyedIterable `` where each element is a ``` Pair ``` that combines the
  element of the current ```` KeyedIterable ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
