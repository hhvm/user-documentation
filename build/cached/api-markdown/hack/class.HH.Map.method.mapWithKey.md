``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` after an operation has been applied to each key and
value in the current `` Map ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
): HH\Map<Tk, Tu>;
```




Every key and value in the current ` Map ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




The keys will remain unchanged from the current ` Map ` to the returned
`` Map ``. The keys are only used to help in the mapping operation.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Map `` keys and values.




## Returns




* ` HH\Map<Tk, Tu> ` - a `` Map `` containing the values after a user-specified operation
  on the current ``` Map ```'s keys and values is applied.




## Examples




This example shows how ` mapWithKey ` can be used to create a new `` Map `` based on ``` $m ```'s keys and values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/mapWithKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
