``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns the last value in the current ` MutableMap `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` MutableMap ``, or ``` null ``` if the
  ```` MutableMap ```` is empty.
<!-- HHAPIDOC -->
