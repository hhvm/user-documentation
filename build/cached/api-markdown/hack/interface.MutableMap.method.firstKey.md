``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableMap"
}
```




Returns the first key in the current ` MutableMap `




``` Hack
public function firstKey(): ?Tk;
```




## Returns




+ ` ?Tk ` - The first key in the current `` MutableMap ``, or ``` null ``` if the
  ```` MutableMap ```` is empty.
<!-- HHAPIDOC -->
