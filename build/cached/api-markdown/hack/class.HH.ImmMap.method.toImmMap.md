``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an immutable copy (` ImmMap `) of the current `` ImmMap ``




``` Hack
public function toImmMap(): ImmMap<Tk, Tv>;
```




## Returns




+ ` ImmMap<Tk, Tv> ` - an `` ImmMap `` that is a copy of the current ``` ImmMap ```.




## Examples




See [` Map::toImmMap `](</hack/reference/class/Map/toImmMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
