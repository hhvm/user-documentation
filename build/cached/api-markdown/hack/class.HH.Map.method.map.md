``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` after an operation has been applied to each value in the
current `` Map ``




``` Hack
public function map<Tu>(
  callable $callback,
): HH\Map<Tk, Tu>;
```




Every value in the current ` Map ` is affected by a call to `` map() ``, unlike
``` filter() ``` where only values that meet a certain criteria are affected.




The keys will remain unchanged from the current ` Map ` to the returned
`` Map ``.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Map `` values.




## Returns




* ` HH\Map<Tk, Tu> ` - a `` Map `` containing key/value pairs after a user-specified
  operation is applied.




## Examples




In this example the ` Map `'s values are mapped to the same type (`` string ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/map/001-map-to-strings.php @@




In this example the ` Map `'s values are mapped to a different type (`` int ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/map/002-map-to-ints.php @@
<!-- HHAPIDOC -->
