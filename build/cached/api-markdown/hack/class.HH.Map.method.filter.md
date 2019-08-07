``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` containing the values of the current `` Map `` that meet
a supplied condition




``` Hack
public function filter(
  callable $callback,
): HH\Map<Tk, Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




The keys associated with the current ` Map ` remain unchanged in the returned
`` Map ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Map `` values.




## Returns




* ` HH\Map<Tk, Tv> ` - a `` Map `` containing the values after a user-specified condition
  is applied.




## Examples




This example shows how ` filter ` returns a new `` Map `` containing only the values (and their corresponding keys) for which ``` $callback ``` returned ```` true ````:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/filter/001-basic-usage.php @@
<!-- HHAPIDOC -->
