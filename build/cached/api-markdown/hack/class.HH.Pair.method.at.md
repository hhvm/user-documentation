``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns the value at the specified key in the current ` Pair `




``` Hack
public function at(
  int $key,
): mixed;
```




If the key is not present, an exception is thrown. This essentially means
if you specify a key other than 0 or 1, you will get an exception. If you
don't want an exception to be thrown, use ` get() ` instead.




$v = $p->at($k)" is semantically equivalent to ` $v = $p[$k] `.




## Parameters




+ ` int $key ` - the key from which to retrieve the value.




## Returns




* ` mixed ` - The value at the specified key; or an exception if the key does
  not exist.




## Examples




This example prints the first and second values of the ` Pair `:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/at/001-existing-key.php @@




This example throws an ` OutOfBoundsException ` because a `` Pair `` only has the indexes ``` 0 ``` and ```` 1 ````:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/at/002-missing-key.php @@
<!-- HHAPIDOC -->
