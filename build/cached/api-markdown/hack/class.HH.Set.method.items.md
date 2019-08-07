``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an ` Iterable ` view of the current `` Set ``




``` Hack
public function items(): HH\Rx\Iterable<Tv>;
```




The ` Iterable ` returned is one that produces the values from the current
`` Set ``.




## Returns




+ ` HH\Rx\Iterable<Tv> ` - The `` Iterable `` view of the current ``` Set ```.




## Examples




This example shows that ` items() ` returns an `` Iterable `` view of the ``` Set ```. The ```` Iterable ```` will produce the values of the ````` Set ````` at the time it's iterated.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/items/001-basic-usage.php @@
<!-- HHAPIDOC -->
