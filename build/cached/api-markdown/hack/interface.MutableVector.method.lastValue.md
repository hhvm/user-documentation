``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
}
```




Returns the last value in the current ` MutableVector `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` MutableVector ``, or ``` null ``` if the
  current ```` MutableVector ```` is empty.
<!-- HHAPIDOC -->
