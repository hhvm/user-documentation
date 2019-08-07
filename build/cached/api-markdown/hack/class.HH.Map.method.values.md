``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Vector ` containing the values of the current `` Map ``




``` Hack
public function values(): Vector<Tv>;
```




This method is interchangeable with ` toVector() `.




## Returns




+ ` Vector<Tv> ` - a `` Vector `` containing the values of the current ``` Map ```.




## Examples




This example shows how ` values() ` is identical to `` toVector() ``. It returns a new ``` Vector ``` of ```` $m ````'s values, so mutating this new ````` Vector ````` doesn't affect the original `````` Map ``````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/values/001-basic-usage.php @@
<!-- HHAPIDOC -->
