``` yamlmeta
{
    "name": "HH\\Iterable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Represents any entity that can be iterated over using something like
` foreach `




The entity does not necessarily have to have a key, just values.




` Iterable ` does not include `` array ``s.




## Interface Synopsis




``` Hack
namespace HH;

interface Iterable implements Traversable, \IteratorAggregate {...}
```




### Public Methods




+ [` ->concat<\Tu super Tv>(\ Traversable<\Tu> $traversable): Iterable<\Tu> `](</hack/reference/interface/HH.Iterable/concat/>)\
  Returns an `` Iterable `` that is the concatenation of the values of the
  current ``` Iterable ``` and the values of the provided ```` Traversable ````
+ [` ->filter(\callable $fn): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/filter/>)\
  Returns an `` Iterable `` containing the values of the current ``` Iterable ``` that
  meet a supplied condition
+ [` ->firstValue(): ?\Tv `](</hack/reference/interface/HH.Iterable/firstValue/>)\
  Returns the first value in the current `` Iterable ``
+ [` ->getIterator(): Iterator<\Tv> `](</hack/reference/interface/HH.Iterable/getIterator/>)\
  Returns an iterator that points to beginning of the current `` Iterable ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/interface/HH.Iterable/lastValue/>)\
  Returns the last value in the current `` Iterable ``
+ [` ->lazy(): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` Iterable ``
+ [` ->map<\Tu>(\callable $fn): Iterable<\Tu> `](</hack/reference/interface/HH.Iterable/map/>)\
  Returns an `` Iterable `` containing the values after an operation has been
  applied to each value in the current ``` Iterable ```
+ [` ->skip(int $n): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/skip/>)\
  Returns an `` Iterable `` containing the values after the ``` n ```-th element of the
  current ```` Iterable ````
+ [` ->skipWhile(\callable $fn): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/skipWhile/>)\
  Returns an `` Iterable `` containing the values of the current ``` Iterable ```
  starting after and including the first value that produces ```` true ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/slice/>)\
  Returns a subset of the current `` Iterable `` starting from a given key up
  to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/take/>)\
  Returns an `` Iterable `` containing the first ``` n ``` values of the current
  ```` Iterable ````
+ [` ->takeWhile(\callable $fn): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/takeWhile/>)\
  Returns an `` Iterable `` containing the values of the current ``` Iterable ``` up
  to but not including the first value that produces ```` false ```` when passed to
  the specified callback
+ [` ->toArray(): \array `](</hack/reference/interface/HH.Iterable/toArray/>)\
  Returns an `` array `` converted from the current ``` Iterable ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/interface/HH.Iterable/toImmSet/>)\
  Returns an immutable set (`` ImmSet ``) converted from the current ``` Iterable ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/interface/HH.Iterable/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) converted from the current
  ``` Iterable ```
+ [` ->toSet(): Set<\Tv> `](</hack/reference/interface/HH.Iterable/toSet/>)\
  Returns a `` Set `` converted from the current ``` Iterable ```
+ [` ->toValuesArray(): \varray<\Tv> `](</hack/reference/interface/HH.Iterable/toValuesArray/>)\
  Returns an `` array `` with the values from the current ``` Iterable ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/interface/HH.Iterable/toVector/>)\
  Returns a `` Vector `` converted from the current ``` Iterable ```
+ [` ->values(): Iterable<\Tv> `](</hack/reference/interface/HH.Iterable/values/>)\
  Returns an `` Iterable `` containing the current ``` Iterable ```'s values
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): Iterable<\Pair<\Tv, \Tu>> `](</hack/reference/interface/HH.Iterable/zip/>)\
  Returns an `` Iterable `` where each element is a ``` Pair ``` that combines the
  element of the current ```` Iterable ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
