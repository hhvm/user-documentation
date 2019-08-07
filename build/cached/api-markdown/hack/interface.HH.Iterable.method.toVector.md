``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns a ` Vector ` converted from the current `` Iterable ``




``` Hack
public function toVector(): Vector<Tv>;
```




Any keys in the current ` Iterable ` are discarded and replaced with integer
indices, starting with 0.




## Returns




+ ` Vector<Tv> ` - a `` Vector `` converted from the current ``` Iterable ```.
<!-- HHAPIDOC -->
