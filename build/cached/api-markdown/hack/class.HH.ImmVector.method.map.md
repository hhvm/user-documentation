``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the results of applying an operation to
each value in the current `` ImmVector ``




``` Hack
public function map<Tu>(
  callable $callback,
): ImmVector<Tu>;
```




` map() `'s result contains a value for every value in the current
`` ImmVector ``; unlike ``` filter() ```, where only values that meet a certain
criterion are included in the resulting ```` ImmVector ````.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmVector ``'s values.




## Returns




* ` ImmVector<Tu> ` - An `` ImmVector `` containing the results of applying a user-specified
  operation to each value of the current ``` ImmVector ``` in turn.




## Examples




See [` Vector::map `](</hack/reference/class/Vector/map/#examples>) for usage examples.
<!-- HHAPIDOC -->
