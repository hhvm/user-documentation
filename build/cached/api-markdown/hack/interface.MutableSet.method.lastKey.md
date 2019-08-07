``` yamlmeta
{
    "name": "lastKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns the last "key" in the current ` MutableSet `




``` Hack
public function lastKey(): ?arraykey;
```




Since sets do not have keys, it returns the last value.




This method is interchangeable with ` lastValue() `.




## Returns




+ ` ?arraykey ` - The last value in the current `` MutableSet ``, or ``` null ``` if the
  current ```` MutableSet ```` is empty.
<!-- HHAPIDOC -->
