``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an immutable vector (` ImmVector `) with the values of the current
`` ImmMap ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` that contains the values of the current ``` ImmMap ```.




## Examples




See [` Map::toImmVector `](</hack/reference/class/Map/toImmVector/#examples>) for usage examples.
<!-- HHAPIDOC -->
