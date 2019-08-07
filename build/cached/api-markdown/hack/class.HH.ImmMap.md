``` yamlmeta
{
    "name": "HH\\ImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




` ImmMap ` is an immutable `` Map ``




HHVM provides a native implementation for
this class. The PHP class definition below is not actually used at run time;
it is simply provided for the typechecker and for developer reference.




A ` ImmMap ` cannot be mutated. No elements can be added or removed from it,
nor can elements be overwritten using assignment (i.e. `` $c[$k] = $v `` is
not allowed).




Construct it with a ` Traversable `:




```
$a = array('a' => 1, 'b' => 2);
$fm = new ImmMap($a);
```




or use the literal syntax




```
$fm = ImmMap {'a' => 1, 'b' => 2};
```




## Interface Synopsis




``` Hack
namespace HH;

final class ImmMap implements \ConstMap {...}
```




### Public Methods




+ [` ::fromItems(?Traversable<\Pair<\Tk, \Tv>> $iterable): \ ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/fromItems/>)\
  Creates an `` ImmMap `` from the given ``` Traversable ```, or an empty ```` ImmMap ````
  if ````` null ````` is passed
+ [` ->__construct(?KeyedTraversable<\Tk, \Tv> $iterable = NULL): \void `](</hack/reference/class/HH.ImmMap/__construct/>)\
  Creates an `` ImmMap `` from the given ``` KeyedTraversable ```, or an empty
  ```` ImmMap ```` if ````` null ````` is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.ImmMap/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.ImmMap/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.ImmMap/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.ImmMap/__toString/>)\
  Returns the `` string `` version of the current ``` ImmMap ```, which is ```` "ImmMap" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.ImmMap/__unset/>)
+ [` ->at(\Tk $key): \Tv `](</hack/reference/class/HH.ImmMap/at/>)\
  Returns the value at the specified key in the current `` ImmMap ``
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): \ ImmVector<\Tu> `](</hack/reference/class/HH.ImmMap/concat/>)\
  Returns an ImmVector that is the concatenation of the values of the
  current `` ImmMap `` and the values of the provided ``` Traversable ```
+ [` ->contains(\mixed $key): bool `](</hack/reference/class/HH.ImmMap/contains/>)\
  Determines if the specified key is in the current `` ImmMap ``
+ [` ->containsKey(\mixed $key): bool `](</hack/reference/class/HH.ImmMap/containsKey/>)\
  Determines if the specified key is in the current `` ImmMap ``
+ [` ->count(): int `](</hack/reference/class/HH.ImmMap/count/>)\
  Provides the number of elements in the current `` ImmMap ``
+ [` ->differenceByKey(KeyedTraversable<\mixed, \mixed> $traversable): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/differenceByKey/>)\
  Returns a new `` ImmMap `` with the keys that are in the current ``` ImmMap ```, but
  not in the provided ```` KeyedTraversable ````
+ [` ->filter(\callable $callback): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/filter/>)\
  Returns an `` ImmMap `` containing the values of the current ``` ImmMap ``` that
  meet a supplied condition
+ [` ->filterWithKey(\callable $callback): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/filterWithKey/>)\
  Returns an `` ImmMap `` containing the values of the current ``` ImmMap ``` that
  meet a supplied condition applied to its keys and values
+ [` ->firstKey(): ?\Tk `](</hack/reference/class/HH.ImmMap/firstKey/>)\
  Returns the first key in the current `` ImmMap ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.ImmMap/firstValue/>)\
  Returns the first value in the current `` ImmMap ``
+ [` ->get(\Tk $key): ?\Tv `](</hack/reference/class/HH.ImmMap/get/>)\
  Returns the value at the specified key in the current `` ImmMap ``
+ [` ->getIterator(): Rx\KeyedIterator<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/getIterator/>)\
  Returns an iterator that points to beginning of the current `` ImmMap ``
+ [` ->immutable(): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/immutable/>)\
  Returns an immutable copy (`` ImmMap ``) of the current ``` ImmMap ```
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.ImmMap/isEmpty/>)\
  Checks if the current `` ImmMap `` is empty
+ [` ->items(): Rx\Iterable<\Pair<\Tk, \Tv>> `](</hack/reference/class/HH.ImmMap/items/>)\
  Returns an `` Iterable `` view of the current ``` ImmMap ```
+ [` ->keys(): ImmVector<\Tk> `](</hack/reference/class/HH.ImmMap/keys/>)\
  Returns an ImmVector containing, as values, the keys of the current `` ImmMap ``
+ [` ->lastKey(): ?\Tk `](</hack/reference/class/HH.ImmMap/lastKey/>)\
  Returns the last key in the current `` ImmMap ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.ImmMap/lastValue/>)\
  Returns the last value in the current `` ImmMap ``
+ [` ->lazy(): Rx\KeyedIterable<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` ImmMap ``
+ [` ->map<\Tu>(\callable $callback): ImmMap<\Tk, \Tu> `](</hack/reference/class/HH.ImmMap/map/>)\
  Returns an `` ImmMap `` after an operation has been applied to each value in
  the current ``` ImmMap ```
+ [` ->mapWithKey<\Tu>(\callable $callback): ImmMap<\Tk, \Tu> `](</hack/reference/class/HH.ImmMap/mapWithKey/>)\
  Returns an `` ImmMap `` after an operation has been applied to each key and
  value in current ``` ImmMap ```
+ [` ->skip(int $n): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/skip/>)\
  Returns an `` ImmMap `` containing the values after the ``` n ```-th element of the
  current ```` ImmMap ````
+ [` ->skipWhile(\callable $fn): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/skipWhile/>)\
  Returns an `` ImmMap `` containing the values of the current ``` ImmMap ``` starting
  after and including the first value that produces ```` true ```` when passed to
  the specified callback
+ [` ->slice(int $start, int $len): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/slice/>)\
  Returns a subset of the current `` ImmMap `` starting from a given key
  location up to, but not including, the element at the provided length from
  the starting key location
+ [` ->take(int $n): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/take/>)\
  Returns an `` ImmMap `` containing the first ``` n ``` key/values of the current
  ```` ImmMap ````
+ [` ->takeWhile(\callable $callback): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/takeWhile/>)\
  Returns an `` ImmMap `` containing the keys and values of the current ``` ImmMap ```
  up to but not including the first value that produces ```` false ```` when passed
  to the specified callback
+ [` ->toArray(): array<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/toArray/>)\
  Returns an `` array `` containing the key/value pairs from the current
  ``` ImmMap ```
+ [` ->toDArray(): darray<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/toDArray/>)
+ [` ->toImmMap(): ImmMap<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/toImmMap/>)\
  Returns an immutable copy (`` ImmMap ``) of the current ``` ImmMap ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.ImmMap/toImmSet/>)\
  Returns an immutable set (`` ImmSet ``) based on the values of the current
  ``` ImmMap ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmMap/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) with the values of the current
  ``` ImmMap ```
+ [` ->toKeysArray(): varray<\Tk> `](</hack/reference/class/HH.ImmMap/toKeysArray/>)\
  Returns an `` array `` whose values are the keys of the current ``` ImmMap ```
+ [` ->toMap(): Map<\Tk, \Tv> `](</hack/reference/class/HH.ImmMap/toMap/>)\
  Returns a mutable copy (`` Map ``) of this ``` ImmMap ```
+ [` ->toSet(): Set<\Tv> `](</hack/reference/class/HH.ImmMap/toSet/>)\
  Returns a `` Set `` based on the values of the current ``` ImmMap ```
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.ImmMap/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.ImmMap/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmMap ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.ImmMap/toVector/>)\
  Returns a `` Vector `` with the values of the current ``` ImmMap ```
+ [` ->values(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmMap/values/>)\
  Returns an ImmVector containing the values of the current `` ImmMap ``
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): \ ImmMap<\Tk, \Pair<\Tv, \Tu>> `](</hack/reference/class/HH.ImmMap/zip/>)\
  Returns an `` ImmMap `` where each value is a ``` Pair ``` that combines the value
  of the current ```` ImmMap ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
