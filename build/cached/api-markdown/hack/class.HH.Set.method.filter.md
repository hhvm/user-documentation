``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing the values of the current `` Set `` that meet
a supplied condition applied to each value




``` Hack
public function filter(
  callable $callback,
): Set<Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Set `` values.




## Returns




* ` Set<Tv> ` - a `` Set `` containing the values after a user-specified condition
  is applied.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/filter/001-basic-usage.php @@
<!-- HHAPIDOC -->
