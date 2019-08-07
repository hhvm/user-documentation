``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns the value at the specified key in the current ` Map `




``` Hack
public function get(
  Tk $key,
): ?Tv;
```




If the key is not present, ` null ` is returned. If you would rather have an
exception thrown when a key is not present, then use `` at() ``.




## Parameters




+ ` Tk $key `




## Returns




* ` ?Tv ` - The value at the specified key; or `` null `` if the key does not
  exist.




## Examples




This example shows how ` get ` can be used to access the value at a key that may not exist:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/get/001-basic-usage.php @@
<!-- HHAPIDOC -->
