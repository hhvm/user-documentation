``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/traits.hhi"
    ],
    "class": "StrictKeyedIterable"
}
```




``` Hack
public function slice(
  int $start,
  int $len,
): KeyedIterable<Tk, Tv>;
```




## Parameters




+ ` int $start `
+ ` int $len `




## Returns




* ` KeyedIterable<Tk, Tv> `
<!-- HHAPIDOC -->
