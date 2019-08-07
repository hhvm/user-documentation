``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstSet"
}
```




Returns a ` ConstVector ` containing the values of the current `` ConstSet ``




``` Hack
public function values(): ConstVector<Tv>;
```




This method is interchangeable with ` keys() `.




## Returns




+ ` ConstVector<Tv> ` - a `` ConstVector `` (integer-indexed) containing the values of the
  current ``` ConstSet ```.
<!-- HHAPIDOC -->
