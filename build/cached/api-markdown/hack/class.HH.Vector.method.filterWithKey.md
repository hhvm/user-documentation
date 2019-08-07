``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values of the current `` Vector `` that meet
a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $callback,
):     Vector<Tv>;
```




` filterWithKey() `'s result contains only values whose key/value pairs
satisfy the provided criterion; unlike `` mapWithKey() ``, which contains
results derived from every key/value pair in the original ``` Vector ```.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  `` Vector ``'s key/value pairs. For each key/value pair,
  the key is passed as the first parameter to the
  callback, and the value is passed as the second
  parameter.




## Returns




* ` Vector<Tv> ` - A `` Vector `` containing the values of the current ``` Vector ``` for
  which a user-specified test condition returns true when applied
  to the corresponding key/value pairs.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/filterWithKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
