``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictIterable"
}
```




``` Hack
public function map<Tu>(
  callable $callback,
): Iterable<Tu>;
```




## Parameters




+ ` callable $callback `




## Returns




* ` Iterable<Tu> `
<!-- HHAPIDOC -->
