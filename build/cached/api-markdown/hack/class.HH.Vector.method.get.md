``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the value at the specified key in the current ` Vector `




``` Hack
public function get(
  int $key,
): ?Tv;
```




If the key is not present, null is returned. If you would rather have an
exception thrown when a key is not present, use ` at() ` instead.




## Parameters




+ ` int $key `




## Returns




* ` ?Tv ` - The value at the specified key; or `` null `` if the key does not
  exist.




## Examples




This example shows how ` get ` can be used to access an index that may not exist:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/get/001-basic-usage.php @@
<!-- HHAPIDOC -->
