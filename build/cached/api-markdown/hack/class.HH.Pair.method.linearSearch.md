``` yamlmeta
{
    "name": "linearSearch",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns the index of the first element that matches the search value




``` Hack
public function linearSearch<Tu super mixed>(
  mixed $search_value,
): int;
```




If no element matches the search value, this function returns -1.




## Parameters




+ ` mixed $search_value ` - The value that will be search for in the current
  `` Pair ``.




## Returns




* ` int ` - The key (index) where that value is found; -1 if it is not found.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/linearSearch/001-basic-usage.php @@
<!-- HHAPIDOC -->
