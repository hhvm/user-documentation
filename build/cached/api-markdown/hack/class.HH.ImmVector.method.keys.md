``` yamlmeta
{
    "name": "keys",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the keys, as values, of the current
`` ImmVector ``




``` Hack
public function keys(): ImmVector<int>;
```




## Returns




+ ` ImmVector<int> ` - An `` ImmVector `` containing, as values, the integer keys of the
  current ``` ImmVector ```.




## Examples




See [` Vector::keys `](</hack/reference/class/Vector/keys/#examples>) for usage examples.
<!-- HHAPIDOC -->
