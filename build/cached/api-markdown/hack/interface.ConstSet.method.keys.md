``` yamlmeta
{
    "name": "keys",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstSet ``




``` Hack
public function keys(): ConstVector<arraykey>;
```




Sets don't have keys, so this will return the values.




This method is interchangeable with ` values() `.




## Returns




+ ` ConstVector<arraykey> ` - a `` ConstVector `` (integer-indexed) containing the values of the
  current ``` ConstSet ```.
<!-- HHAPIDOC -->
