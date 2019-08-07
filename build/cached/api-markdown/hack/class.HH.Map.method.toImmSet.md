``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns an immutable set (` ImmSet `) based on the values of the current
`` Map ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` with the current values of the current ``` Map ```.




## Examples




This example shows that converting a ` Map ` to an `` ImmSet `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toImmSet/001-basic-usage.php @@
<!-- HHAPIDOC -->
