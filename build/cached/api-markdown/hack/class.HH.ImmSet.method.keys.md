``` yamlmeta
{
    "name": "keys",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmVector ` containing the values of this `` ImmSet ``




``` Hack
public function keys(): ImmVector<arraykey>;
```




` ImmSet `s don't have keys, so this will return the values.




This method is interchangeable with ` toImmVector() ` and `` values() ``.




## Returns




+ ` ImmVector<arraykey> ` - an `` ImmVector `` containing the values of the current ``` ImmSet ```.




## Examples




See [` Set::keys `](</hack/reference/class/Set/keys/#examples>) for usage examples.
<!-- HHAPIDOC -->
