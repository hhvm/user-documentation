``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values after an operation has been applied
to each value in the current `` Set ``




``` Hack
public function map<Tu as arraykey>(
  callable $callback,
): Set<Tu>;
```




Every value in the current ` Set ` is affected by a call to `` map() ``, unlike
``` filter() ``` where only values that meet a certain criteria are affected.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Set `` values.




## Returns




* ` Set<Tu> ` - a `` Set `` containing the values after a user-specified operation
  is applied.




## Examples




In this example the ` Set `'s elements are mapped to the same type (`` string ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/map/001-map-to-strings.php @@




In this example the ` Set `'s elements are mapped to a different type (`` int ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/map/002-map-to-ints.php @@
<!-- HHAPIDOC -->
