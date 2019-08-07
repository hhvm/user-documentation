``` yamlmeta
{
    "name": "isEmpty",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns ` false `; a `` Pair `` cannot be empty




``` Hack
public function isEmpty(): bool;
```




## Returns




+ ` bool ` - `` false ``




## Examples




This example shows that a ` Pair ` can never be empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/isEmpty/001-basic-usage.php @@
<!-- HHAPIDOC -->
