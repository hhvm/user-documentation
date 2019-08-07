``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns the value at the specified key in the current ` Map `




``` Hack
public function at(
  Tk $key,
): Tv;
```




If the key is not present, an exception is thrown. If you don't want an
exception to be thrown, use ` get() ` instead.




` $v = $map->at($k) ` is equivalent to `` $v = $map[$k] ``.




## Parameters




+ ` Tk $key `




## Returns




* ` Tv ` - The value at the specified key; or an exception if the key does
  not exist.




## Examples




This example prints the values at the keys ` red ` and `` green `` in the ``` Map ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/at/001-existing-key.php @@




This example throws an ` OutOfBoundsException ` because the `` Map `` has no key 'blurple':







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/at/002-missing-key.php @@
<!-- HHAPIDOC -->
