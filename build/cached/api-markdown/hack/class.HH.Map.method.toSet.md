``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Set ` based on the values of the current `` Map ``




``` Hack
public function toSet(): Set<Tv>;
```




## Returns




+ ` Set<Tv> ` - a `` Set `` with the current values of the current ``` Map ```.




## Examples




This example shows that converting a ` Map ` to a `` Set `` also removes duplicate values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toSet/001-basic-usage.php @@
<!-- HHAPIDOC -->
