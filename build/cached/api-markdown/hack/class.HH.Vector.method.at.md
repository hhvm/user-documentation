``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the value at the specified key in the current ` Vector `




``` Hack
public function at(
  int $key,
): Tv;
```




If the key is not present, an exception is thrown. If you don't want an
exception to be thrown, use ` get() ` instead.




` $v = $vec->at($k) ` is semantically equivalent to `` $v = $vec[$k] ``.




## Parameters




+ ` int $key `




## Returns




* ` Tv ` - The value at the specified key; or an exception if the key does
  not exist.




## Examples




This example prints the first and last values of the ` Vector `:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/at/001-existing-key.php @@




This example throws an ` OutOfBoundsException ` because the `` Vector `` has no index 10:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/at/002-missing-key.php @@
<!-- HHAPIDOC -->
