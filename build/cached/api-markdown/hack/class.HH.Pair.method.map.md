``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values after an operation has been
applied to each value in the current `` Pair ``




``` Hack
public function map<Tu>(
  callable $callback,
): ImmVector<Tu>;
```




Every value in the current Pair is affected by a call to ` map() `, unlike
`` filter() `` where only values that meet a certain criteria are affected.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` Pair `` values.




## Returns




* ` ImmVector<Tu> ` - an `` ImmVector `` containing the values after a user-specified
  operation is applied.




## Examples




In this example the ` Pair `'s values are mapped to `` 0 `` if they're ``` NULL ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/map/001-basic-usage.php @@
<!-- HHAPIDOC -->
