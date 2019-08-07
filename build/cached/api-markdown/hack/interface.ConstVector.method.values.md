``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns a ` ConstVector ` containing the values of the current
`` ConstVector ``




``` Hack
public function values(): ConstVector<Tv>;
```




Essentially a copy of the current ` ConstVector `.




This method is interchangeable with ` toVector() `.




## Returns




+ ` ConstVector<Tv> ` - a `` ConstVector `` containing the values of the current
  ``` ConstVector ```.
<!-- HHAPIDOC -->
