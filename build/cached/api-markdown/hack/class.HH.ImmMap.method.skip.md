``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the values after the `` n ``-th element of the
current ``` ImmMap ```




``` Hack
public function skip(
  int $n,
): ImmMap<Tk, Tv>;
```




The returned ` ImmMap ` will always be a proper subset of the current
`` ImmMap ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ImmMap ```.




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` that is a proper subset of the current ``` ImmMap ```
  containing values after the specified ```` n ````-th element.




## Examples




See [` Map::skip `](</hack/reference/class/Map/skip/#examples>) for usage examples.
<!-- HHAPIDOC -->
