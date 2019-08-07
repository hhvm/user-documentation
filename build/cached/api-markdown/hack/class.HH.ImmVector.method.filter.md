``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns a ` ImmVector ` containing the values of the current `` ImmVector `` that
meet a supplied condition




``` Hack
public function filter(
  callable $callback,
): ImmVector<Tv>;
```




` filter() `'s result contains only values that meet the provided criterion;
unlike `` map() ``, where a value is included for each value in the original
``` ImmVector ```.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` ImmVector `` values.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` containing the values after a user-specified
  condition is applied.




## Examples




See [` Vector::filter `](</hack/reference/class/Vector/filter/#examples>) for usage examples.
<!-- HHAPIDOC -->
