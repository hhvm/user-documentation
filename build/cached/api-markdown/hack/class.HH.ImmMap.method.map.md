``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` after an operation has been applied to each value in
the current `` ImmMap ``




``` Hack
public function map<Tu>(
  callable $callback,
): HH\ImmMap<Tk, Tu>;
```




Every value in the current ` ImmMap ` is affected by a call to `` map() ``,
unlike ``` filter() ``` where only values that meet a certain criteria are
affected.




The keys will remain unchanged from this ` ImmMap ` to the returned `` ImmMap ``.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmMap `` values.




## Returns




* ` HH\ImmMap<Tk, Tu> ` - an `` ImmMap `` containing key/value pairs after a user-specified
  operation is applied.




## Examples




See [` Map::map `](</hack/reference/class/Map/map/#examples>) for usage examples.
<!-- HHAPIDOC -->
