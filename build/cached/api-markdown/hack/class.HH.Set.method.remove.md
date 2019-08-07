``` yamlmeta
{
    "name": "remove",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Removes the specified value from the current ` Set `




``` Hack
public function remove(
  Tv $val,
): Set<Tv>;
```




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` Tv $val `




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples




This example shows that removing a value that doesn't exist in the ` Set ` has no effect:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/remove/001-basic-usage.php @@
<!-- HHAPIDOC -->
