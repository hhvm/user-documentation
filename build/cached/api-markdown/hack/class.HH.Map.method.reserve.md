``` yamlmeta
{
    "name": "reserve",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Reserves enough memory to accommodate a given number of elements




``` Hack
public function reserve(
  int $sz,
): void;
```




Reserves enough memory for ` sz ` elements. If `` sz `` is less than or
equal to the current capacity of this ``` Map ```, this method does nothing.




## Parameters




+ ` int $sz ` - The pre-determined size you want for the current `` Map ``.




## Returns




* ` void `




## Examples




This example reserves space for 1000 elements and then fills the ` Map ` with 1000 integer keys and values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/reserve/001-basic-usage.php @@
<!-- HHAPIDOC -->
