``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmVector ` containing the values of the current `` ImmSet ``




``` Hack
public function values(): ImmVector<Tv>;
```




This method is interchangeable with ` toImmVector() ` and `` keys() ``.




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` containing the values of the current ``` ImmSet ```.




## Examples




See [` Set::values `](</hack/reference/class/Set/values/#examples>) for usage examples.
<!-- HHAPIDOC -->
