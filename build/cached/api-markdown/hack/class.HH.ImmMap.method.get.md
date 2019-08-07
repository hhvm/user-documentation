``` yamlmeta
{
    "name": "get",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns the value at the specified key in the current ` ImmMap `




``` Hack
public function get(
  Tk $key,
): ?Tv;
```




If the key is not present, null is returned. If you would rather have an
exception thrown when a key is not present, then use ` at() `.




## Parameters




+ ` Tk $key `




## Returns




* ` ?Tv ` - The value at the specified key; or `` null `` if the key does not
  exist.




## Examples




See [` Map::get `](</hack/reference/class/Map/get/#examples>) for usage examples.
<!-- HHAPIDOC -->
