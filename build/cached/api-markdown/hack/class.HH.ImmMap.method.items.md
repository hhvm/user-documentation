``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` Iterable ` view of the current `` ImmMap ``




``` Hack
public function items(): HH\Rx\Iterable<Pair<Tk, Tv>>;
```




The ` Iterable ` returned is one that produces the key/values from the
current `` ImmMap ``.




## Returns




+ ` HH\Rx\Iterable<Pair<Tk, Tv>> ` - The `` Iterable `` view of the current ``` ImmMap ```.




## Examples




See [` Map::items `](</hack/reference/class/Map/items/#examples>) for usage examples.
<!-- HHAPIDOC -->
