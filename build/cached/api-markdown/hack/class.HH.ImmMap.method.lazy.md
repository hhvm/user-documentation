``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns a lazy, access elements only when needed view of the current
` ImmMap `




``` Hack
public function lazy(): HH\Rx\KeyedIterable<Tk, Tv>;
```




Normally, memory is allocated for all of the elements of an ` ImmMap `. With
a lazy view, memory is allocated for an element only when needed or used
in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` HH\Rx\KeyedIterable<Tk, Tv> ` - a `` KeyedIterable `` representing the lazy view into the current
  ``` ImmMap ```.




## Examples




See [` Map::lazy `](</hack/reference/class/Map/lazy/#examples>) for usage examples.
<!-- HHAPIDOC -->
