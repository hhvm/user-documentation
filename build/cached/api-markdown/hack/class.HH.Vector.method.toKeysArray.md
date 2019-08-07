``` yamlmeta
{
    "name": "toKeysArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns an ` array ` whose values are the keys from the current `` Vector ``




``` Hack
public function toKeysArray(): HH\varray<int>;
```




## Returns




+ ` HH\varray<int> ` - An `` array `` with the integer keys from the current ``` Vector ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toKeysArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
