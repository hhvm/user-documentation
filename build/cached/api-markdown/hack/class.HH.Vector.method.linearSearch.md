``` yamlmeta
{
    "name": "linearSearch",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the index of the first element that matches the search value




``` Hack
public function linearSearch(
  mixed $search_value,
): int;
```




If no element matches the search value, this function returns -1.




## Parameters




+ ` mixed $search_value ` - The value that will be searched for in the current
  `` Vector ``.




## Returns




* ` int ` - The key (index) where that value is found; -1 if it is not found.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/linearSearch/001-basic-usage.php @@
<!-- HHAPIDOC -->
