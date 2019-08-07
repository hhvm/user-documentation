``` yamlmeta
{
    "name": "contains",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Determines if the specified key is in the current ` Map `




``` Hack
public function contains(
  mixed $key,
): bool;
```




This function is interchangeable with ` containsKey() `.




## Parameters




+ ` mixed $key `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current ``` Map ```;
  returns ```` false ```` otherwise.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/contains/001-basic-usage.php @@
<!-- HHAPIDOC -->
