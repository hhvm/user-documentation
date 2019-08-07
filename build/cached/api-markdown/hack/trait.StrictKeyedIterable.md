``` yamlmeta
{
    "name": "StrictKeyedIterable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




## Interface Synopsis




``` Hack
trait StrictKeyedIterable implements HH\KeyedIterable {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): Iterable<Tu> `](</hack/reference/trait/StrictKeyedIterable/concat/>)
+ [` ->filter(callable $callback): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/filter/>)
+ [` ->filterWithKey(callable $callback): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/filterWithKey/>)
+ [` ->firstKey(): ?Tk `](</hack/reference/trait/StrictKeyedIterable/firstKey/>)
+ [` ->firstValue(): ?Tv `](</hack/reference/trait/StrictKeyedIterable/firstValue/>)
+ [` ->keys(): Iterable<Tk> `](</hack/reference/trait/StrictKeyedIterable/keys/>)
+ [` ->lastKey(): ?Tk `](</hack/reference/trait/StrictKeyedIterable/lastKey/>)
+ [` ->lastValue(): ?Tv `](</hack/reference/trait/StrictKeyedIterable/lastValue/>)
+ [` ->lazy(): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/lazy/>)
+ [` ->map<Tu>(callable $callback): KeyedIterable<Tk, Tu> `](</hack/reference/trait/StrictKeyedIterable/map/>)
+ [` ->mapWithKey<Tu>(callable $callback): KeyedIterable<Tk, Tu> `](</hack/reference/trait/StrictKeyedIterable/mapWithKey/>)
+ [` ->skip(int $n): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/skip/>)
+ [` ->skipWhile(callable $fn): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/skipWhile/>)
+ [` ->slice(int $start, int $len): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/slice/>)
+ [` ->take(int $n): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/take/>)
+ [` ->takeWhile(callable $fn): KeyedIterable<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/takeWhile/>)
+ [` ->toArray(): array `](</hack/reference/trait/StrictKeyedIterable/toArray/>)
+ [` ->toImmMap(): ImmMap<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/toImmMap/>)
+ [` ->toImmSet(): ImmSet<Tv> `](</hack/reference/trait/StrictKeyedIterable/toImmSet/>)
+ [` ->toImmVector(): ImmVector<Tv> `](</hack/reference/trait/StrictKeyedIterable/toImmVector/>)
+ [` ->toKeysArray(): varray<Tk> `](</hack/reference/trait/StrictKeyedIterable/toKeysArray/>)
+ [` ->toMap(): Map<Tk, Tv> `](</hack/reference/trait/StrictKeyedIterable/toMap/>)
+ [` ->toSet(): Set<Tv> `](</hack/reference/trait/StrictKeyedIterable/toSet/>)
+ [` ->toValuesArray(): varray<Tv> `](</hack/reference/trait/StrictKeyedIterable/toValuesArray/>)
+ [` ->toVector(): Vector<Tv> `](</hack/reference/trait/StrictKeyedIterable/toVector/>)
+ [` ->values(): Iterable<Tv> `](</hack/reference/trait/StrictKeyedIterable/values/>)
+ [` ->zip<Tu>( Traversable<Tu> $traversable): KeyedIterable<Tk, Pair<Tv, Tu>> `](</hack/reference/trait/StrictKeyedIterable/zip/>)
<!-- HHAPIDOC -->
