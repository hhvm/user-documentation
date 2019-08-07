``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




``` Hack
public function filterWithKey(
  callable $callback,
): KeyedIterable<Tk, Tv>;
```




## Parameters




+ ` callable $callback `




## Returns




* ` KeyedIterable<Tk, Tv> `
<!-- HHAPIDOC -->
