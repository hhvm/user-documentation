``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstVector"
}
```




Returns the last value in the current ` ConstVector `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` ConstVector ``, or ``` null ``` if the
  current ```` ConstVector ```` is empty.
<!-- HHAPIDOC -->
