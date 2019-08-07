``` yamlmeta
{
    "name": "clear",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Removes all the elements from the current ` Vector `




``` Hack
public function clear(): Vector<Tv>;
```




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Returns




+ ` Vector<Tv> ` - Returns itself.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/clear/001-basic-usage.php @@
<!-- HHAPIDOC -->
