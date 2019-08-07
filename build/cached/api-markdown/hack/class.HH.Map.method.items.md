``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an ` Iterable ` view of the current `` Map ``




``` Hack
public function items(): HH\Rx\Iterable<Pair<Tk, Tv>>;
```




The ` Iterable ` returned is one that produces the key/values from the
current `` Map ``.




## Returns




+ ` HH\Rx\Iterable<Pair<Tk, Tv>> ` - The `` Iterable `` view of the current ``` Map ```.




## Examples




This example shows that ` items() ` returns an `` Iterable `` view of the ``` Map ```. The ```` Iterable ```` will produce the key-value pairs of the ````` Map ````` at the time it's iterated.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/items/001-basic-usage.php @@
<!-- HHAPIDOC -->
