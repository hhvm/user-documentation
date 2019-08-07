``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictIterable"
}
```




``` Hack
public function filter(
  callable $callback,
): Iterable<Tv>;
```




## Parameters




+ ` callable $callback `




## Returns




* ` Iterable<Tv> `
<!-- HHAPIDOC -->
