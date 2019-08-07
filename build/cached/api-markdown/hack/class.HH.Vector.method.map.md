``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the results of applying an operation to each
value in the current `` Vector ``




``` Hack
public function map<Tu>(
  callable $callback,
): Vector<Tu>;
```




` map() `'s result contains a value for every value in the current `` Vector ``;
unlike ``` filter() ```, where only values that meet a certain criterion are
included in the resulting ```` Vector ````.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Vector ``'s values.




## Returns




* ` Vector<Tu> ` - A `` Vector `` containing the results of applying a user-specified
  operation to each value of the current ``` Vector ``` in turn.




## Examples




In this example the ` Vector `'s elements are mapped to the same type (`` string ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/map/001-map-to-strings.php @@




In this example the ` Vector `'s elements are mapped to a different type (`` int ``s):







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/map/002-map-to-ints.php @@
<!-- HHAPIDOC -->
