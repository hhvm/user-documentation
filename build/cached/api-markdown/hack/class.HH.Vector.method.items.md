``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an ` Iterable ` view of the current `` Vector ``




``` Hack
public function items(): HH\Rx\Iterable<Tv>;
```




The ` Iterable ` returned is one that produces the values from the current
`` Vector ``.




## Returns




+ ` HH\Rx\Iterable<Tv> ` - The `` Iterable `` view of the current ``` Vector ```.




## Examples




This example shows that ` items() ` returns an `` Iterable `` view of the ``` Vector ```. The ```` Iterable ```` will produce the values of the ````` Vector ````` at the time it's iterated.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/items/001-basic-usage.php @@
<!-- HHAPIDOC -->
