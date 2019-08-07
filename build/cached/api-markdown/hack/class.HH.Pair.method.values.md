``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values of the current `` Pair ``




``` Hack
public function values(): ImmVector<mixed>;
```




This method is interchangeable with ` toImmVector() `.




## Returns




+ ` ImmVector<mixed> ` - an `` ImmVector `` containing the values of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/values/001-basic-usage.php @@
<!-- HHAPIDOC -->
