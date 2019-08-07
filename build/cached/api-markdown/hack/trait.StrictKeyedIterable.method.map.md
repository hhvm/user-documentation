``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




``` Hack
public function map<Tu>(
  callable $callback,
): KeyedIterable<Tk, Tu>;
```




## Parameters




+ ` callable $callback `




## Returns




* ` KeyedIterable<Tk, Tu> `
<!-- HHAPIDOC -->
