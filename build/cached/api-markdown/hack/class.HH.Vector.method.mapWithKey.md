``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the results of applying an operation to each
key/value pair in the current `` Vector ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
): Vector<Tu>;
```




` mapWithKey() `'s result contains a value for every key/value pair in the
current `` Vector ``; unlike ``` filterWithKey() ```, where only values whose
key/value pairs meet a certain criterion are included in the resulting
```` Vector ````.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Vector ``'s key/value pairs.




## Returns




* ` Vector<Tu> ` - A `` Vector `` containing the results of applying a user-specified
  operation to each key/value pair of the current ``` Vector ``` in turn.




## Examples




This example shows how ` mapWithKey ` can be used to create a new `` Vector `` based on ``` $v ```'s keys and values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/mapWithKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
