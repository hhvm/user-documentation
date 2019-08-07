``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns a ` ImmVector ` containing the values of the current `` Pair `` that
meet a supplied condition




``` Hack
public function filter(
  callable $callback,
): ImmVector<mixed>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Pair `` values.




## Returns




* ` ImmVector<mixed> ` - an `` ImmVector `` containing the values after a user-specified
  condition is applied.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/filter/001-basic-usage.php @@
<!-- HHAPIDOC -->
