``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ImmVector that is the concatenation of the values of the
current ` ImmMap ` and the values of the provided `` Traversable ``




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
):     ImmVector<Tu>;
```




The provided ` Traversable ` is concatenated to the end of the current
`` ImmMap `` to produce the returned ``` ImmVector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to this ``` ImmMap ```.




## Returns




* ` ImmVector<Tu> ` - The integer-indexed concatenated `` ImmVector ``.




## Examples




See [` Map::concat `](</hack/reference/class/Map/concat/#examples>) for usage examples.
<!-- HHAPIDOC -->
