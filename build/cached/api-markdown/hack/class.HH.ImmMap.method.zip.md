``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` where each value is a `` Pair `` that combines the value
of the current ``` ImmMap ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     ImmMap<Tk, Pair<Tv, Tu>>;
```




If the number of values of the current ` ImmMap ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




The keys associated with the current ` ImmMap ` remain unchanged in the
returned `` ImmMap ``.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` ImmMap ```.




## Returns




* ` ImmMap<Tk, Pair<Tv, Tu>> ` - The `` ImmMap `` that combines the values of the current ``` ImmMap ```
  with the provided ```` Traversable ````.




## Examples




See [` Map::zip `](</hack/reference/class/Map/zip/#examples>) for usage examples.
<!-- HHAPIDOC -->
