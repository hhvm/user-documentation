``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
): KeyedIterable<Tk, Tu>;
```




## Parameters




+ ` callable $callback `




## Returns




* ` KeyedIterable<Tk, Tu> `
<!-- HHAPIDOC -->
