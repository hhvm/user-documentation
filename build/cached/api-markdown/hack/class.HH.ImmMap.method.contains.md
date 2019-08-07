``` yamlmeta
{
    "name": "contains",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Determines if the specified key is in the current ` ImmMap `




``` Hack
public function contains(
  mixed $key,
): bool;
```




This function is interchangeable with ` containsKey() `.




## Parameters




+ ` mixed $key `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current ``` ImmMap ```;
  ```` false ```` otherwise.




## Examples




See [` Map::contains `](</hack/reference/class/Map/contains/#examples>) for usage examples.
<!-- HHAPIDOC -->
