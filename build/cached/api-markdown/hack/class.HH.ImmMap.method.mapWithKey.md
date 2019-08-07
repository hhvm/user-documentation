``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` after an operation has been applied to each key and
value in current `` ImmMap ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
): HH\ImmMap<Tk, Tu>;
```




Every key and value in the current ` ImmMap ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




The keys will remain unchanged from the current ` ImmMap ` to the returned
`` ImmMap ``. The keys are only used to help in the operation.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmMap `` keys and values.




## Returns




* ` HH\ImmMap<Tk, Tu> ` - an `` ImmMap `` containing the values after a user-specified
  operation on the current ``` ImmMap ```'s keys and values is applied.




## Examples




See [` Map::mapWithKey `](</hack/reference/class/Map/mapWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
