``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an immutable set (` ImmSet `) based on the values of the current
`` ImmMap ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` with the current values of the current ``` ImmMap ```.




## Examples




See [` Map::toImmSet `](</hack/reference/class/Map/toImmSet/#examples>) for usage examples.
<!-- HHAPIDOC -->
