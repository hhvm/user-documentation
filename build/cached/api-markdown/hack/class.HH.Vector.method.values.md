``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values of the current `` Vector ``




``` Hack
public function values(): Vector<Tv>;
```




Essentially a copy of the current ` Vector `.




This method is interchangeable with ` toVector() `.




## Returns




+ ` Vector<Tv> ` - A `` Vector `` containing the values of the current ``` Vector ```.




## Examples




This example shows how ` values() ` is identical to `` toVector() ``. It returns a deep copy of ``` $v ```, so mutating this new ```` Vector ```` doesn't affect the original.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/values/001-basic-usage.php @@
<!-- HHAPIDOC -->
