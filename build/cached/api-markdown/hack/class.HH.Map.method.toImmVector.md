``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an immutable vector (` ImmVector `) with the values of the current
`` Map ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` that is an immutable copy of the current ``` Map ```.




## Examples




This example shows that ` toImmVector ` returns an immutable copy of the `` Map ``'s values. Mutating the ``` Vector ``` of values doesn't affect the original ```` Map ```` and vice-versa.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toImmVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
