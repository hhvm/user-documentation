``` yamlmeta
{
    "name": "linearSearch",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MutableVector"
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




+ ` mixed $search_value ` - The value that will be search for in the current
  `` MutableVector ``.




## Returns




* ` int ` - The key (index) where that value is found; -1 if it is not found.
<!-- HHAPIDOC -->
