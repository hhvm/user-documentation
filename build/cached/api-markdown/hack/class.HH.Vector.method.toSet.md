``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Set ` based on the values of the current `` Vector ``




``` Hack
public function toSet(): Set<Tv>;
```




## Returns




+ ` Set<Tv> ` - A `` Set `` containing the unique values of the current ``` Vector ```.




## Examples




This example shows that converting a ` Vector ` to a `` Set `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toSet/001-basic-usage.php @@
<!-- HHAPIDOC -->
