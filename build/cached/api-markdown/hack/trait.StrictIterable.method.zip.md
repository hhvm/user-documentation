``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictIterable"
}
```




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): Iterable<Pair<Tv, Tu>>;
```




## Parameters




+ ` Traversable<Tu> $traversable `




## Returns




* ` Iterable<Pair<Tv, Tu>> `
<!-- HHAPIDOC -->
