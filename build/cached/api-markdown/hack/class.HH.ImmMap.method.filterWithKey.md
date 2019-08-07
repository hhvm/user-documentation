``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the values of the current `` ImmMap `` that
meet a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $callback,
): HH\ImmMap<Tk, Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




The keys associated with the current ` ImmMap ` remain unchanged in the
returned `` ImmMap ``; the keys will be used in the filtering process only.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` ImmMap `` keys and values.




## Returns




* ` HH\ImmMap<Tk, Tv> ` - an `` ImmMap `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` ImmMap ```.




## Examples




See [` Map::filterWithKey `](</hack/reference/class/Map/filterWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
