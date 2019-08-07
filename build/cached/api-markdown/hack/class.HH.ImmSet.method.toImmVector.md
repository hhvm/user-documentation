``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an immutable vector (` ImmVector `) with the values of the current
`` ImmSet ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` (integer-indexed) with the values of the current
  ``` ImmSet ```.




## Examples




See [` Set::toImmVector `](</hack/reference/class/Set/toImmVector/#examples>) for usage examples.
<!-- HHAPIDOC -->
