``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an immutable vector (` ImmVector `) converted from the current
`` Iterable ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




Any keys in the current ` Iterable ` are discarded and replaced with integer
indices, starting with 0.




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` converted from the current ``` Iterable ```.
<!-- HHAPIDOC -->
