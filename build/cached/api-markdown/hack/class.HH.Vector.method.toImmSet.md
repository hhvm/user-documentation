``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an immutable set (` ImmSet `) based on the values of the current
`` Vector ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




## Returns




+ ` ImmSet<Tv> ` - An `` ImmSet `` containing the unique values of the current ``` Vector ```.




## Examples




This example shows that converting a ` Vector ` to an `` ImmSet `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toImmSet/001-basic-usage.php @@
<!-- HHAPIDOC -->
