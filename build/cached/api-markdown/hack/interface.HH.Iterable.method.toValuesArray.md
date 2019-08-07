``` yamlmeta
{
    "name": "toValuesArray",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an ` array ` with the values from the current `` Iterable ``




``` Hack
public function toValuesArray(): varray<Tv>;
```




The keys in the current ` Iterable ` are discarded and replaced with integer
indices, starting with 0.




## Returns




+ ` varray<Tv> ` - an `` array `` containing the values from the current ``` Iterable ```.
<!-- HHAPIDOC -->
