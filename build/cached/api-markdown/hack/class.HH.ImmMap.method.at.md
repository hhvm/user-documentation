``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns the value at the specified key in the current ` ImmMap `




``` Hack
public function at(
  Tk $key,
): Tv;
```




If the key is not present, an exception is thrown. If you don't want an
exception to be thrown, use ` get() ` instead.




` $v = $map->at($k) ` is semantically equivalent to `` $v = $map[$k] ``.




## Parameters




+ ` Tk $key `




## Returns




* ` Tv ` - The value at the specified key; or an exception if the key does
  not exist.




## Examples




See [` Map::at `](</hack/reference/class/Map/at/#examples>) for usage examples.
<!-- HHAPIDOC -->
