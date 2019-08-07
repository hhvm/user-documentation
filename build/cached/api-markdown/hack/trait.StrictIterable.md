``` yamlmeta
{
    "name": "StrictIterable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictIterable"
}
```




This file provides type information for some of PHP's predefined interfaces




YOU SHOULD NEVER INCLUDE THIS FILE ANYWHERE!!!




## Interface Synopsis




``` Hack
trait StrictIterable implements HH\Iterable {...}
```




### Public Methods




+ [` ->concat<Tu super Tv>(Traversable<Tu> $traversable): Iterable<Tu> `](</hack/reference/trait/StrictIterable/concat/>)
+ [` ->filter(callable $callback): Iterable<Tv> `](</hack/reference/trait/StrictIterable/filter/>)
+ [` ->firstValue(): ?Tv `](</hack/reference/trait/StrictIterable/firstValue/>)
+ [` ->lastValue(): ?Tv `](</hack/reference/trait/StrictIterable/lastValue/>)
+ [` ->lazy(): Iterable<Tv> `](</hack/reference/trait/StrictIterable/lazy/>)
+ [` ->map<Tu>(callable $callback): Iterable<Tu> `](</hack/reference/trait/StrictIterable/map/>)
+ [` ->skip(int $n): Iterable<Tv> `](</hack/reference/trait/StrictIterable/skip/>)
+ [` ->skipWhile(callable $fn): Iterable<Tv> `](</hack/reference/trait/StrictIterable/skipWhile/>)
+ [` ->slice(int $start, int $len): Iterable<Tv> `](</hack/reference/trait/StrictIterable/slice/>)
+ [` ->take(int $n): Iterable<Tv> `](</hack/reference/trait/StrictIterable/take/>)
+ [` ->takeWhile(callable $fn): Iterable<Tv> `](</hack/reference/trait/StrictIterable/takeWhile/>)
+ [` ->toArray(): array `](</hack/reference/trait/StrictIterable/toArray/>)
+ [` ->toImmSet(): ImmSet<Tv> `](</hack/reference/trait/StrictIterable/toImmSet/>)
+ [` ->toImmVector(): ImmVector<Tv> `](</hack/reference/trait/StrictIterable/toImmVector/>)
+ [` ->toSet(): Set<Tv> `](</hack/reference/trait/StrictIterable/toSet/>)
+ [` ->toValuesArray(): varray<Tv> `](</hack/reference/trait/StrictIterable/toValuesArray/>)
+ [` ->toVector(): Vector<Tv> `](</hack/reference/trait/StrictIterable/toVector/>)
+ [` ->values(): Iterable<Tv> `](</hack/reference/trait/StrictIterable/values/>)
+ [` ->zip<Tu>(Traversable<Tu> $traversable): Iterable<Pair<Tv, Tu>> `](</hack/reference/trait/StrictIterable/zip/>)
<!-- HHAPIDOC -->
