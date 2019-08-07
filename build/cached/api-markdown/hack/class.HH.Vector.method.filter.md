``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values of the current `` Vector `` that meet
a supplied condition




``` Hack
public function filter(
  callable $callback,
): Vector<Tv>;
```




` filter() `'s result contains only values that meet the provided criterion;
unlike `` map() ``, where a value is included for each value in the original
``` Vector ```.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  `` Vector `` values.




## Returns




* ` Vector<Tv> ` - A `` Vector `` containing the values after a user-specified condition
  is applied.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/filter/001-basic-usage.php @@
<!-- HHAPIDOC -->
