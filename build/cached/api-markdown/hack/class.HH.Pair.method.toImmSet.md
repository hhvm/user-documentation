``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an immutable set (` ImmSet `) with the values of the current `` Pair ``




``` Hack
public function toImmSet(): ImmSet<arraykey, mixed>;
```




## Returns




+ ` ImmSet<arraykey, mixed> ` - an `` ImmSet `` with the current values of the current ``` Pair ```.




## Examples




This example shows that converting a ` Pair ` to an `` ImmSet `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toImmSet/001-basic-usage.php @@




This example shows that converting a ` Pair ` to an `` ImmSet `` will throw a fatal error if the ``` Pair ``` contains a value that's not a ```` string ```` or an ````` int `````:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toImmSet/002-runtime-fatal.php @@
<!-- HHAPIDOC -->
