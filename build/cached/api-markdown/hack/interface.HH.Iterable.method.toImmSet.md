``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an immutable set (` ImmSet `) converted from the current `` Iterable ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




Any keys in the current ` Iterable ` are discarded.




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` converted from the current ``` Iterable ```.
<!-- HHAPIDOC -->
