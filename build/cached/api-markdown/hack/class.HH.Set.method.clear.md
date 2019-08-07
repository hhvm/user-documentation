``` yamlmeta
{
    "name": "clear",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Remove all the elements from the current ` Set `




``` Hack
public function clear(): Set<Tv>;
```




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Returns




+ ` Set<Tv> ` - Returns itself.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/clear/001-basic-usage.php @@
<!-- HHAPIDOC -->
