``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns the value at the specified key in the current ` Pair `




``` Hack
public function get(
  int $key,
): mixed;
```




If the key is not present, ` null ` is returned. If you would rather have an
exception thrown when a key is not present, then use `` at() ``.




## Parameters




+ ` int $key ` - the key from which to retrieve the value.




## Returns




* ` mixed ` - The value at the specified key; or `` null `` if the key does not
  exist.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/get/001-basic-usage.php @@
<!-- HHAPIDOC -->
