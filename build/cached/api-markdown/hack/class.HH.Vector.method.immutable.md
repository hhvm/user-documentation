``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an immutable copy (` ImmVector `) of the current `` Vector ``




``` Hack
public function immutable(): HH\ImmVector<Tv>;
```




This method is interchangeable with ` toImmVector() `.




## Returns




+ ` HH\ImmVector<Tv> ` - An `` ImmVector `` copy of the current ``` Vector ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/immutable/001-basic-usage.php @@
<!-- HHAPIDOC -->
