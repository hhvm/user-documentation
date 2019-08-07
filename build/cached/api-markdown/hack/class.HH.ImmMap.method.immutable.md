``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an immutable copy (` ImmMap `) of the current `` ImmMap ``




``` Hack
public function immutable(): ImmMap<Tk, Tv>;
```




This method is interchangeable with ` toImmMap() `.




## Returns




+ ` ImmMap<Tk, Tv> ` - an `` ImmMap `` representing a copy of the current ``` ImmMap ```.




## Examples




See [` Map::immutable `](</hack/reference/class/Map/immutable/#examples>) for usage examples.
<!-- HHAPIDOC -->
