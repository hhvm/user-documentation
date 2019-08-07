``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an immutable integer-keyed Map (` ImmMap `) based on the elements of
the current `` ImmVector ``




``` Hack
public function toImmMap(): ImmMap<int, Tv>;
```




The keys are ` 0... count() - 1 `.




## Returns




+ ` ImmMap<int, Tv> ` - An integer-keyed `` ImmMap `` with the values of the current
  ``` ImmVector ```.




## Examples




See [` Vector::toImmMap `](</hack/reference/class/Vector/toImmMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
