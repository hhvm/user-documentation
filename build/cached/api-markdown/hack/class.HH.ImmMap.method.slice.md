``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns a subset of the current ` ImmMap ` starting from a given key
location up to, but not including, the element at the provided length from
the starting key location




``` Hack
public function slice(
  int $start,
  int $len,
): ImmMap<Tk, Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
keys and values at key location 0 and 1.




The returned ` ImmMap ` will always be a proper subset of the current
`` ImmMap ``.




## Parameters




+ ` int $start ` - The starting key location of the current `` ImmMap `` for the
  returned ``` ImmMap ```.
+ ` int $len ` - The length of the returned `` ImmMap ``.




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` that is a proper subset of the current ``` ImmMap ```
  starting at ```` $start ```` up to but not including the element
  ````` $start + $len `````.




## Examples




See [` Map::slice `](</hack/reference/class/Map/slice/#examples>) for usage examples.
<!-- HHAPIDOC -->
