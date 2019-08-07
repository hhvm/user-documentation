``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




``` Hack
public function zip<Tu>(
      Traversable<Tu> $traversable,
): KeyedIterable<Tk, Pair<Tv, Tu>>;
```




## Parameters




+ ` Traversable<Tu> $traversable `




## Returns




* ` KeyedIterable<Tk, Pair<Tv, Tu>> `
<!-- HHAPIDOC -->
