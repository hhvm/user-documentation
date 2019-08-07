``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an integer-keyed ` Map ` based on the values of the current `` Vector ``




``` Hack
public function toMap(): Map<int, Tv>;
```




## Returns




+ ` Map<int, Tv> ` - A `` Map `` that has the integer keys and associated values of the
  current ``` Vector ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
