``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an immutable copy (` ImmVector `) of the current `` Vector ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




## Returns




+ ` ImmVector<Tv> ` - A `` Vector `` that is an immutable copy of the current ``` Vector ```.




## Examples




This example shows that ` toImmVector ` returns an immutable copy of the `` Vector ``. Mutating the original ``` Vector ``` doesn't affect the immutable copy.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toImmVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
