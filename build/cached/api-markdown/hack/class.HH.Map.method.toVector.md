``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Vector ` with the values of the current `` Map ``




``` Hack
public function toVector(): Vector<Tv>;
```




## Returns




+ ` Vector<Tv> ` - a `` Vector `` that contains the values of the current ``` Map ```.




## Examples




This example shows how ` toVector() ` returns a `` Vector `` of ``` $m ```'s values, so mutating this new ```` Vector ```` doesn't affect the original ````` Map `````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/toVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
