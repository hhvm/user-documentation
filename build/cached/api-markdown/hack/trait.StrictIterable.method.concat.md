``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictIterable"
}
```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): Iterable<Tu>;
```




## Parameters




+ ` Traversable<Tu> $traversable `




## Returns




* ` Iterable<Tu> `
<!-- HHAPIDOC -->
