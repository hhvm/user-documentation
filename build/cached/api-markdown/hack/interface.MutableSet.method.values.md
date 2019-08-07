``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableSet ``




``` Hack
public function values(): MutableVector<Tv>;
```




This method is interchangeable with ` keys() `.




## Returns




+ ` MutableVector<Tv> ` - a `` MutableVector `` (integer-indexed) containing the values of the
  current ``` MutableSet ```.
<!-- HHAPIDOC -->
