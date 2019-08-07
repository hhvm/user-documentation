``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns a mutable copy (` Map `) of this `` ImmMap ``




``` Hack
public function toMap(): Map<Tk, Tv>;
```




## Returns




+ ` Map<Tk, Tv> ` - a mutable `` Map `` that is a copy of the current ``` ImmMap ```.




## Examples




See [` Map::toMap `](</hack/reference/class/Map/toMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
