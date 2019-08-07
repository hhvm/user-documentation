``` yamlmeta
{
    "name": "clear",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Remove all the elements from the current ` Map `




``` Hack
public function clear(): Map<Tk, Tv>;
```




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Returns




+ ` Map<Tk, Tv> ` - Returns itself.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/clear/001-basic-usage.php @@
<!-- HHAPIDOC -->
