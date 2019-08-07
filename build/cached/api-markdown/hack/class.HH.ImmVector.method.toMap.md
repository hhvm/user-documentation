``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an integer-keyed ` Map ` based on the elements of the current
`` ImmVector ``




``` Hack
public function toMap(): Map<int, Tv>;
```




The keys are ` 0... count() - 1 `.




## Returns




+ ` Map<int, Tv> ` - An integer-keyed `` Map `` with the values of the current
  ``` ImmVector ```.




## Examples




See [` Vector::toMap `](</hack/reference/class/Vector/toMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
