``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns a ` MutableVector ` containing the values of the current
`` MutableVector ``




``` Hack
public function values(): MutableVector<Tv>;
```




Essentially a copy of the current ` MutableVector `.




This method is interchangeable with ` toVector() `.




## Returns




+ ` MutableVector<Tv> ` - a `` MutableVector `` containing the values of the current
  ``` MutableVector ```.
<!-- HHAPIDOC -->
