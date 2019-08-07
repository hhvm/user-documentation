``` yamlmeta
{
    "name": "HH\\ImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




` ImmSet ` is an immutable, ordered set-style collection




HHVM provides a
native implementation for this class. The PHP class definition below is not
actually used at run time; it is simply provided for the typechecker and
for developer reference.




An ` ImmSet ` cannot be mutated. No elements can be added or removed from it,
nor can elements be overwritten using assignment (i.e. `` $s[$k] = $v `` is
not allowed).




Construct it with a ` Traversable `:




```
$a = array(1, 2);
$s = new ImmSet($a);
```




or use the literal syntax:




```
$s = ImmSet {1, 2};
```




## Interface Synopsis




``` Hack
namespace HH;

final class ImmSet implements \ConstSet {...}
```




### Public Methods




+ [` ::fromArrays(...$argv): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/fromArrays/>)\
  Returns an `` ImmSet `` containing all the values from the specified
  ``` array ```(s)
+ [` ::fromItems(?Traversable<\Tv> $iterable): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/fromItems/>)\
  Creates an `` ImmSet `` from the given ``` Traversable ```, or an empty ```` ImmSet ```` if
  ````` null ````` is passed
+ [` ::fromKeysOf<\Tk as arraykey>(?KeyedContainer<\Tk, \mixed> $container): ImmSet<\Tk> `](</hack/reference/class/HH.ImmSet/fromKeysOf/>)\
  Creates an `` ImmSet `` from the keys of the specified container
+ [` ->__construct(?Traversable<\Tv> $iterable = NULL): \void `](</hack/reference/class/HH.ImmSet/__construct/>)\
  Creates an `` ImmSet `` from the given ``` Traversable ```, or an empty ```` ImmSet ```` if
  ````` null ````` is passed
+ [` ->__get(\mixed $name): \mixed `](</hack/reference/class/HH.ImmSet/__get/>)
+ [` ->__isset(\mixed $name): bool `](</hack/reference/class/HH.ImmSet/__isset/>)
+ [` ->__set(\mixed $name, \mixed $value): \mixed `](</hack/reference/class/HH.ImmSet/__set/>)
+ [` ->__toString(): string `](</hack/reference/class/HH.ImmSet/__toString/>)\
  Returns the `` string `` version of this ``` ImmSet ```, which is ```` "ImmSet" ````
+ [` ->__unset(\mixed $name): \mixed `](</hack/reference/class/HH.ImmSet/__unset/>)
+ [` ->concat<\Tu super Tv>(Traversable<\Tu> $traversable): ImmVector<\Tu> `](</hack/reference/class/HH.ImmSet/concat/>)\
  Returns an `` ImmVector `` that is the concatenation of the values of the
  current ``` ImmSet ``` and the values of the provided ```` Traversable ````
+ [` ->contains(\mixed $val): bool `](</hack/reference/class/HH.ImmSet/contains/>)\
  Determines if the specified value is in the current `` ImmSet ``
+ [` ->count(): int `](</hack/reference/class/HH.ImmSet/count/>)\
  Provides the number of elements in the current `` ImmSet ``
+ [` ->filter(\callable $callback): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/filter/>)\
  Returns an `` ImmSet `` containing the values of the current ``` ImmSet ``` that
  meet a supplied condition applied to each value
+ [` ->filterWithKey(\callable $callback): \ ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/filterWithKey/>)\
  Returns an `` ImmSet `` containing the values of the current ``` ImmSet ``` that
  meet a supplied condition applied to its "keys" and values
+ [` ->firstKey(): ?\arraykey `](</hack/reference/class/HH.ImmSet/firstKey/>)\
  Returns the first "key" in the current `` ImmSet ``
+ [` ->firstValue(): ?\Tv `](</hack/reference/class/HH.ImmSet/firstValue/>)\
  Returns the first value in the current `` ImmSet ``
+ [` ->getIterator(): Rx\KeyedIterator<\arraykey, \Tv> `](</hack/reference/class/HH.ImmSet/getIterator/>)\
  Returns an iterator that points to beginning of the current `` ImmSet ``
+ [` ->immutable(): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/immutable/>)\
  Returns an immutable copy (`` ImmSet ``) of the current ``` ImmSet ```
+ [` ->isEmpty(): bool `](</hack/reference/class/HH.ImmSet/isEmpty/>)\
  Checks if the current `` ImmSet `` is empty
+ [` ->items(): Rx\Iterable<\Tv> `](</hack/reference/class/HH.ImmSet/items/>)\
  Returns an Iterable view of the current `` ImmSet ``
+ [` ->keys(): ImmVector<\arraykey> `](</hack/reference/class/HH.ImmSet/keys/>)\
  Returns an `` ImmVector `` containing the values of this ``` ImmSet ```
+ [` ->lastKey(): ?\arraykey `](</hack/reference/class/HH.ImmSet/lastKey/>)\
  Returns the last "key" in the current `` ImmSet ``
+ [` ->lastValue(): ?\Tv `](</hack/reference/class/HH.ImmSet/lastValue/>)\
  Returns the last value in the current `` ImmSet ``
+ [` ->lazy(): Rx\KeyedIterable<\arraykey, \Tv> `](</hack/reference/class/HH.ImmSet/lazy/>)\
  Returns a lazy, access elements only when needed view of the current
  `` ImmSet ``
+ [` ->map<\Tu as arraykey>(\callable $callback): ImmSet<\Tu> `](</hack/reference/class/HH.ImmSet/map/>)\
  Returns an `` ImmSet `` containing the values after an operation has been
  applied to each value in the current ``` ImmSet ```
+ [` ->mapWithKey<\Tu as arraykey>(\callable $callback): ImmSet<\Tu> `](</hack/reference/class/HH.ImmSet/mapWithKey/>)\
  Returns an `` ImmSet `` containing the values after an operation has been
  applied to each "key" and value in the current ``` ImmSet ```
+ [` ->skip(int $n): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/skip/>)\
  Returns an `` ImmSet `` containing the values after the ``` n ```-th element of the
  current ```` ImmSet ````
+ [` ->skipWhile(\callable $fn): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/skipWhile/>)\
  Returns an `` ImmSet `` containing the values of the current ``` ImmSet ``` starting
  after and including the first value that produces ```` true ```` when passed to
  the specified callback
+ [` ->slice(int $start, int $len): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/slice/>)\
  Returns a subset of the current `` ImmSet `` starting from a given key up to,
  but not including, the element at the provided length from the starting
  key
+ [` ->take(int $n): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/take/>)\
  Returns an `` ImmSet `` containing the first n values of the current ``` ImmSet ```
+ [` ->takeWhile(\callable $callback): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/takeWhile/>)\
  Returns an `` ImmSet `` containing the values of the current ``` ImmSet ``` up to
  but not including the first value that produces ```` false ```` when passed to the
  specified callback
+ [` ->toArray(): array<\Tv, \Tv> `](</hack/reference/class/HH.ImmSet/toArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmSet ```
+ [` ->toDArray(): darray<\Tv, \Tv> `](</hack/reference/class/HH.ImmSet/toDArray/>)
+ [` ->toImmMap(): ImmMap<\arraykey, \Tv> `](</hack/reference/class/HH.ImmSet/toImmMap/>)\
  Returns an immutable map (`` ImmMap ``) based on the values of the current
  ``` ImmSet ```
+ [` ->toImmSet(): ImmSet<\Tv> `](</hack/reference/class/HH.ImmSet/toImmSet/>)\
  Returns an immutable copy (`` ImmSet ``) of the current ``` ImmSet ```
+ [` ->toImmVector(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmSet/toImmVector/>)\
  Returns an immutable vector (`` ImmVector ``) with the values of the current
  ``` ImmSet ```
+ [` ->toKeysArray(): varray<\Tv> `](</hack/reference/class/HH.ImmSet/toKeysArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmSet ```
+ [` ->toMap(): Map<\arraykey, \Tv> `](</hack/reference/class/HH.ImmSet/toMap/>)\
  Returns a `` Map `` based on the values of the current ``` ImmSet ```
+ [` ->toSet(): Set<\Tv> `](</hack/reference/class/HH.ImmSet/toSet/>)\
  Returns a mutable copy (`` Set ``) of the current ``` ImmSet ```
+ [` ->toVArray(): varray<\Tv> `](</hack/reference/class/HH.ImmSet/toVArray/>)
+ [` ->toValuesArray(): varray<\Tv> `](</hack/reference/class/HH.ImmSet/toValuesArray/>)\
  Returns an `` array `` containing the values from the current ``` ImmSet ```
+ [` ->toVector(): Vector<\Tv> `](</hack/reference/class/HH.ImmSet/toVector/>)\
  Returns a `` Vector `` of the current ``` ImmSet ``` values
+ [` ->values(): ImmVector<\Tv> `](</hack/reference/class/HH.ImmSet/values/>)\
  Returns an `` ImmVector `` containing the values of the current ``` ImmSet ```
+ [` ->zip<\Tu>(Traversable<\Tu> $traversable): ImmSet<\Pair<\Tv, \Tu>> `](</hack/reference/class/HH.ImmSet/zip/>)\
  Throws an exception unless the current `` ImmSet `` or the ``` Traversable ``` is
  empty
<!-- HHAPIDOC -->
