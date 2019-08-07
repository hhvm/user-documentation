``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns a ` Set ` with the values of the current `` Pair ``




``` Hack
public function toSet(): Set<arraykey, mixed>;
```




## Returns




+ ` Set<arraykey, mixed> ` - a `` Set `` with the current values of the current ``` Pair ```.




## Examples




This example shows that converting a ` Pair ` to a `` Set `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toSet/001-basic-usage.php @@




This example shows that converting a ` Pair ` to a `` Set `` will throw a fatal error if the ``` Pair ``` contains a value that's not a ```` string ```` or an ````` int `````:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toSet/002-runtime-fatal.php @@
<!-- HHAPIDOC -->
