``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Returns an ` ImmMap ` containing the values of the current `` ImmMap `` that
meet a supplied condition




``` Hack
public function filter(
  callable $callback,
): HH\ImmMap<Tk, Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




The keys associated with the current ` ImmMap ` remain unchanged in the
returned `` Map ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` ImmMap `` values.




## Returns




* ` HH\ImmMap<Tk, Tv> ` - an `` ImmMap `` containing the values after a user-specified
  condition is applied.




## Examples




See [` Map::filter `](</hack/reference/class/Map/filter/#examples>) for usage examples.
<!-- HHAPIDOC -->
