``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an integer-keyed ` Map ` based on the elements of the current `` Pair ``




``` Hack
public function toMap(): Map<int, mixed>;
```




The keys are 0 and 1.




## Returns




+ ` Map<int, mixed> ` - an integer-keyed `` Map `` with the values of the current ``` Pair ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/toMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
