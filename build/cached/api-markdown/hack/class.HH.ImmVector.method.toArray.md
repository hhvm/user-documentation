``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` array ` containing the values from the current `` ImmVector ``




``` Hack
public function toArray(): HH\array<Tv>;
```




This method is interchangeable with ` toValuesArray() `.




## Returns




+ ` HH\array<Tv> ` - An `` array `` containing the values from the current ``` ImmVector ```.




## Examples




See [` Vector::toArray `](</hack/reference/class/Vector/toArray/#examples>) for usage examples.
<!-- HHAPIDOC -->
