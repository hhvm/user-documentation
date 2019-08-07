``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableSet"
}
```




Returns the last value in the current ` MutableSet `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` MutableSet ``, or ``` null ``` if the
  current ```` MutableSet ```` is empty.
<!-- HHAPIDOC -->
