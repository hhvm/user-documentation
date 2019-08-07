``` yamlmeta
{
    "name": "differenceByKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns a new ` ImmMap ` with the keys that are in the current `` ImmMap ``, but
not in the provided ``` KeyedTraversable ```




``` Hack
public function differenceByKey(
  KeyedTraversable<mixed, mixed> $traversable,
): ImmMap<Tk, Tv>;
```




## Parameters




+ ` KeyedTraversable<mixed, mixed> $traversable ` - The `` KeyedTraversable `` on which to compare the keys.




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` containing the keys (and associated values) of the
  current ``` ImmMap ``` that are not in the ```` KeyedTraversable ````.




## Examples




See [` Map::differenceByKey `](</hack/reference/class/Map/differenceByKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
