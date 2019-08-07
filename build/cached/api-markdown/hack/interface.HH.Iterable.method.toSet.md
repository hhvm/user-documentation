``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns a ` Set ` converted from the current `` Iterable ``




``` Hack
public function toSet(): Set<Tv>;
```




Any keys in the current ` Iterable ` are discarded.




## Returns




+ ` Set<Tv> ` - a `` Set `` converted from the current ``` Iterable ```.
<!-- HHAPIDOC -->
