``` yamlmeta
{
    "name": "linearSearch",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
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
  `` ImmVector ``.




## Returns




* ` int ` - The key (index) where that value is found; -1 if it is not found.




## Examples




See [` Vector::linearSearch `](</hack/reference/class/Vector/linearSearch/#examples>) for usage examples.
<!-- HHAPIDOC -->
