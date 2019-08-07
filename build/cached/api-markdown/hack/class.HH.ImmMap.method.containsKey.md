``` yamlmeta
{
    "name": "containsKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Determines if the specified key is in the current ` ImmMap `




``` Hack
public function containsKey(
  mixed $key,
): bool;
```




This function is interchangeable with ` contains() `.




## Parameters




+ ` mixed $key `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current ``` ImmMap ```;
  ```` false ```` otherwise.




## Examples




See [` Map::containsKey `](</hack/reference/class/Map/containsKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
