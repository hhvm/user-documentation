``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` Iterable ` view of the current `` Pair ``




``` Hack
public function items(): HH\Rx\Iterable<mixed>;
```




The ` Iterable ` returned is one that produces the values from the current
`` Pair ``.




## Returns




+ ` HH\Rx\Iterable<mixed> ` - The `` Iterable `` view of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/items/001-basic-usage.php @@
<!-- HHAPIDOC -->
