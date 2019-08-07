``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an iterator that points to beginning of the current ` ImmMap `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<Tk, Tv>;
```




## Returns




+ ` HH\Rx\KeyedIterator<Tk, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current
  ``` ImmMap ```.




## Examples




See [` Map::getIterator `](</hack/reference/class/Map/getIterator/#examples>) for usage examples.
<!-- HHAPIDOC -->
