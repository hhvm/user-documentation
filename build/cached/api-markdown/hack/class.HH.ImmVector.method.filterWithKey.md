``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the values of the current `` ImmVector ``
that meet a supplied condition applied to its keys and values




``` Hack
public function filterWithKey(
  callable $callback,
):     ImmVector<Tv>;
```




` filterWithKey() `'s result contains only values whose key/value pairs
satisfy the provided criterion; unlike `` mapWithKey() ``, which contains
results derived from every key/value pair in the original ``` ImmVector ```.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  `` ImmVector ``'s key/value pairs. For each key/value pair,
  the key is passed as the first parameter to the
  callback, and the value is passed as the second
  parameter.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` containing the values of the current ``` ImmVector ```
  for which a user-specified test condition returns true when
  applied to the corresponding key/value pairs.




## Examples




See [` Vector::filterWithKey `](</hack/reference/class/Vector/filterWithKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
