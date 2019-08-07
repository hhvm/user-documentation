``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the keys and values of the current `` ImmMap ``
up to but not including the first value that produces ``` false ``` when passed
to the specified callback




``` Hack
public function takeWhile(
  callable $callback,
): HH\ImmMap<Tk, Tv>;
```




The returned ` ImmMap ` will always be a proper subset of the current
`` ImmMap ``.




## Parameters




+ ` callable $callback `




## Returns




* ` HH\ImmMap<Tk, Tv> ` - An `` ImmMap `` that is a proper subset of the current ``` ImmMap ``` up
  until when the callback returns ```` false ````.




## Examples




See [` Map::takeWhile `](</hack/reference/class/Map/takeWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
