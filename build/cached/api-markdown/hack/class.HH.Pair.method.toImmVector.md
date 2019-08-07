``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an immutable vector (` ImmVector `) containing the elements of the
current `` Pair ``




``` Hack
public function toImmVector(): ImmVector<mixed>;
```




## Returns




+ ` ImmVector<mixed> ` - an `` ImmVector `` with the elements of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toImmVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
