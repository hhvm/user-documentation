``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the first `` n `` key/values of the current
``` ImmMap ```




``` Hack
public function take(
  int $n,
): ImmMap<Tk, Tv>;
```




The returned ` ImmMap ` will always be a proper subset of the current
`` ImmMap ``.




` n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` ImmMap ``.




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` that is a proper subset of the current ``` ImmMap ``` up
  to ```` n ```` elements.




## Examples




See [` Map::take `](</hack/reference/class/Map/take/#examples>) for usage examples.
<!-- HHAPIDOC -->
