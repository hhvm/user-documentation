``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the values of the current `` Map `` that meet
a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $callback,
): HH\Map<Tk, Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




The keys associated with the current ` Map ` remain unchanged in the
returned `` Map ``; the keys will be used in the filtering process only.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Map `` keys and values.




## Returns




* ` HH\Map<Tk, Tv> ` - a `` Map `` containing the values after a user-specified condition
  is applied to the keys and values of the current ``` Map ```.




## Examples




This example shows how ` filterWithKey ` allows you to use an element's value and corresponding key to determine whether to include it in the filtered `` Map ``.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/filterWithKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
