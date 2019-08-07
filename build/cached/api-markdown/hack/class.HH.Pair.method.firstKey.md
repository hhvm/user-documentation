``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns the first key in the current ` Pair `




``` Hack
public function firstKey(): int;
```




The return will always be 0 since a ` Pair ` only has two keys, 0 and 1.




## Returns




+ ` int ` - 0




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/firstKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
