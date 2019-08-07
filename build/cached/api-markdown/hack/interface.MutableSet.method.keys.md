``` yamlmeta
{
    "name": "keys",
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
public function keys(): MutableVector<arraykey>;
```




Sets don't have keys, so this will return the values.




This method is interchangeable with ` values() `.




## Returns




+ ` MutableVector<arraykey> ` - a `` MutableVector `` (integer-indexed) containing the values of the
  current ``` MutableSet ```.
<!-- HHAPIDOC -->
