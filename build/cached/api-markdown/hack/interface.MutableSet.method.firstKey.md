``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns the first "key" in the current ` MutableSet `




``` Hack
public function firstKey(): ?arraykey;
```




Since sets do not have keys, it returns the first value.




This method is interchangeable with ` firstValue() `.




## Returns




+ ` ?arraykey ` - The first value in the current `` MutableSet ``, or ``` null ``` if the
  ```` MutableSet ```` is empty.
<!-- HHAPIDOC -->
