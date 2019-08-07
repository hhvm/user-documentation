``` yamlmeta
{
    "name": "reserve",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Reserves enough memory to accommodate a given number of elements




``` Hack
public function reserve(
  int $sz,
): void;
```




Reserves enough memory for ` $sz ` elements. If `` $sz `` is less than or
equal to the current capacity of the current ``` Vector ```, this method does
nothing.




If ` $sz ` is less than zero, an exception is thrown.




## Parameters




+ ` int $sz ` - The pre-determined size you want for the current `` Vector ``.




## Returns




* ` void `




## Examples




This example reserves space for 1000 elements and then fills the ` Vector ` with 1000 integers:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/reserve/001-basic-usage.php @@
<!-- HHAPIDOC -->
