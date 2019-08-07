``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an ` array ` containing the values from the current `` Vector ``




``` Hack
public function toArray(): HH\array<Tv>;
```




This method is interchangeable with ` toValuesArray() `.




## Returns




+ ` HH\array<Tv> ` - An `` array `` containing the values from the current ``` Vector ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
