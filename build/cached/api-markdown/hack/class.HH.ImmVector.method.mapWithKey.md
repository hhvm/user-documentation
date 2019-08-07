``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the results of applying an operation to
each key/value pair in the current `` ImmVector ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
):     ImmVector<Tu>;
```




` mapWithKey() `'s result contains a value for every key/value pair in the
current `` ImmVector ``; unlike ``` filterWithKey() ```, where only values whose
key/value pairs meet a certain criterion are included in the resulting
```` ImmVector ````.




## Parameters




+ ` callable $callback ` - The callback containing the operation to apply to the
  current `` ImmVector ``'s key/value pairs.




## Returns




* ` ImmVector<Tu> ` - An `` ImmVector `` containing the results of applying a
  user-specified operation to each key/value pair of the current
  ``` ImmVector ``` in turn.




## Examples




See [` Vector::mapWithKey `](</hack/reference/class/Vector/mapWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
