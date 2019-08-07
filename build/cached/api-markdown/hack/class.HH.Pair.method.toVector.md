``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns a ` Vector ` containing the elements of the current `` Pair ``




``` Hack
public function toVector(): Vector<mixed>;
```




The returned ` Vector ` will, of course, be mutable.




## Returns




+ ` Vector<mixed> ` - a `` Vector `` with the elements of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
