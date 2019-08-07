``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an immutable Set (` ImmSet `) with the values of the current
`` ImmVector ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




## Returns




+ ` ImmSet<Tv> ` - An `` ImmSet `` with the current values of the current ``` ImmVector ```.




## Examples




See [` Vector::toImmSet `](</hack/reference/class/Vector/toImmSet/#examples>) for usage examples.
<!-- HHAPIDOC -->
