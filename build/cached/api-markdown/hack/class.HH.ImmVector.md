``` yamlmeta
{
    "name": "HH\\ImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




` ImmVector ` is an immutable `` Vector ``




HHVM provides a native implementation
for this class. The PHP class definition below is not actually used at run
time; it is simply provided for the typechecker and for developer reference.




An ` ImmVector ` cannot be mutated. No elements can be added to it or removed
from it, nor can elements be overwritten using assignment (i.e. `` $c[$k] = $v ``
is not allowed).




```
$v = Vector {1, 2, 3};
$fv = $v->toImmVector();
```




construct it with a ` Traversable `:




```
$a = array(1, 2, 3);
$fv = new ImmVector($a);
```




or use the literal syntax:




```
$fv = ImmVector {1, 2, 3};
```




## Interface Synopsis




``` Hack
namespace HH;

final class ImmVector implements \ConstVector {...}
```




### Public Methods




+ [` ::fromItems(?Traversable<\Tv> $iterable): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/fromItems/>)\
  Creates an `` ImmVector `` from the given ``` Traversable ```, or an empty
  ```` ImmVector ```` if ````` null ````` is passed
+ [` ::fromKeysOf<\Tk as arraykey>(?KeyedContainer<\Tk, \mixed> $container): ImmVector<\Tk> `](</hack/reference/class/HH.ImmVector/fromKeysOf/>)\
  Creates an `` ImmVector `` from the keys of the specified container
+ [` ->__construct(?Traversable<\Tv> $iterable = NULL): \void `](</hack/reference/class/HH.ImmVector/__construct/>)\
  Creates an `` ImmVector `` from the given ``` Traversable ```, or an empty
  ```` ImmVector ```` if ````` null ````` is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.ImmVector/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.ImmVector/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.ImmVector/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.ImmVector/__toString/>)\
  Returns the `` string `` version of the current ``` ImmVector ```, which is
  ```` "ImmVector" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.ImmVector/__unset/>)
+ [` ->at(int $key): \Tv `](</hack/reference/class/HH.ImmVector/at/>)\
  Returns the value at the specified key in the current `` ImmVector ``
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): ImmVector<\Tu> `](</hack/reference/class/HH.ImmVector/concat/>)\
  Returns an `` ImmVector `` that is the concatenation of the values of the
  current ``` ImmVector ``` and the values of the provided ```` Traversable ````
+ [` ->containsKey(\mixed $key): bool `](</hack/reference/class/HH.ImmVector/containsKey/>)\
  Determines if the specified key is in the current `` ImmVector ``
+ [` ->count(): int `](</hack/reference/class/HH.ImmVector/count/>)\
  Returns the number of elements in the current `` ImmVector ``
+ [` ->filter(\callable $callback): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/filter/>)\
  Returns a `` ImmVector `` containing the values of the current ``` ImmVector ``` that
  meet a supplied condition
+ [` ->filterWithKey(\callable $callback): \ ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/filterWithKey/>)\
  Returns an `` ImmVector `` containing the values of the current ``` ImmVector ```
  that meet a supplied condition applied to its keys and values
+ [` ->firstKey(): ?int `](</hack/reference/class/HH.ImmVector/firstKey/>)\
  Returns the first key in the current `` ImmVector ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.ImmVector/firstValue/>)\
  Returns the first value in the current `` ImmVector ``
+ [` ->get(int $key): ?\Tv `](</hack/reference/class/HH.ImmVector/get/>)\
  Returns the value at the specified key in the current `` ImmVector ``
+ [` ->getIterator(): Rx\KeyedIterator<int, \Tv> `](</hack/reference/class/HH.ImmVector/getIterator/>)\
  Returns an iterator that points to beginning of the current `` ImmVector ``
+ [` ->immutable(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/immutable/>)\
  Returns the current `` ImmVector ``
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.ImmVector/isEmpty/>)\
  Checks if the current `` ImmVector `` is empty
+ [` ->items(): Rx\Iterable<\Tv> `](</hack/reference/class/HH.ImmVector/items/>)\
  Returns an `` Iterable `` view of the current ``` ImmVector ```
+ [` ->keys(): ImmVector<int> `](</hack/reference/class/HH.ImmVector/keys/>)\
  Returns an `` ImmVector `` containing the keys, as values, of the current
  ``` ImmVector ```
+ [` ->lastKey(): ?int `](</hack/reference/class/HH.ImmVector/lastKey/>)\
  Returns the last key in the current `` ImmVector ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.ImmVector/lastValue/>)\
  Returns the last value in the current `` ImmVector ``
+ [` ->lazy(): Rx\KeyedIterable<int, \Tv> `](</hack/reference/class/HH.ImmVector/lazy/>)\
  Returns a lazy, access-elements-only-when-needed view of the current
  `` ImmVector ``
+ [` ->linearSearch(\mixed $search_value): int `](</hack/reference/class/HH.ImmVector/linearSearch/>)\
  Returns the index of the first element that matches the search value
+ [` ->map<\Tu>(\callable $callback): ImmVector<\Tu> `](</hack/reference/class/HH.ImmVector/map/>)\
  Returns an `` ImmVector `` containing the results of applying an operation to
  each value in the current ``` ImmVector ```
+ [` ->mapWithKey<\Tu>(\callable $callback): \ ImmVector<\Tu> `](</hack/reference/class/HH.ImmVector/mapWithKey/>)\
  Returns an `` ImmVector `` containing the results of applying an operation to
  each key/value pair in the current ``` ImmVector ```
+ [` ->skip(int $n): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/skip/>)\
  Returns an `` ImmVector `` containing the values after the ``` $n ```-th element of
  the current ```` ImmVector ````
+ [` ->skipWhile(\callable $fn): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/skipWhile/>)\
  Returns an `` ImmVector `` containing the values of the current ``` ImmVector ```
  starting after and including the first value that produces ```` false ```` when
  passed to the specified callback
+ [` ->slice(int $start, int $len): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/slice/>)\
  Returns a subset of the current `` ImmVector `` starting from a given key up
  to, but not including, the element at the provided length from the
  starting key
+ [` ->take(int $n): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/take/>)\
  Returns an `` ImmVector `` containing the first ``` $n ``` values of the current
  ```` ImmVector ````
+ [` ->takeWhile(\callable $callback): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/takeWhile/>)\
  Returns an `` ImmVector `` containing the values of the current ``` ImmVector ``` up
  to but not including the first value that produces ```` false ```` when passed to
  the specified callback
+ [` ->toArray(): array<\Tv> `](</hack/reference/class/HH.ImmVector/toArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmVector ```
+ [` ->toDArray(): darray<int, \Tv> `](</hack/reference/class/HH.ImmVector/toDArray/>)
+ [` ->toImmMap(): ImmMap<int, \Tv> `](</hack/reference/class/HH.ImmVector/toImmMap/>)\
  Returns an immutable integer-keyed Map (`` ImmMap ``) based on the elements of
  the current ``` ImmVector ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.ImmVector/toImmSet/>)\
  Returns an immutable Set (`` ImmSet ``) with the values of the current
  ``` ImmVector ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/toImmVector/>)\
  Returns the current `` ImmVector ``
+ [` ->toKeysArray(): varray<\Tv> `](</hack/reference/class/HH.ImmVector/toKeysArray/>)\
  Returns an `` array `` whose values are the keys from the current ``` ImmVector ```
+ [` ->toMap(): Map<int, \Tv> `](</hack/reference/class/HH.ImmVector/toMap/>)\
  Returns an integer-keyed `` Map `` based on the elements of the current
  ``` ImmVector ```
+ [` ->toSet(): Set<\Tv> `](</hack/reference/class/HH.ImmVector/toSet/>)\
  Returns a `` Set `` with the values of the current ``` ImmVector ```
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.ImmVector/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.ImmVector/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmVector ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.ImmVector/toVector/>)\
  Returns a `` Vector `` containing the elemnts of the current ``` ImmVector ```
+ [` ->values(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmVector/values/>)\
  Returns a new `` ImmVector `` containing the values of the current ``` ImmVector ```;
  that is, a copy of the current ```` ImmVector ````
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): \ ImmVector<\Pair<\Tv, \Tu>> `](</hack/reference/class/HH.ImmVector/zip/>)\
  Returns an `` ImmVector `` where each element is a ``` Pair ``` that combines the
  element of the current ```` ImmVector ```` and the provided ````` Traversable `````
<!-- HHAPIDOC -->
