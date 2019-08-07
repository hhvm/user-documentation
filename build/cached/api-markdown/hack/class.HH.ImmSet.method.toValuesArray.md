``` yamlmeta
{
    "name": "toValuesArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` array ` containing the values from the current `` ImmSet ``




``` Hack
public function toValuesArray(): HH\varray<Tv>;
```




This method is interchangeable with ` toKeysArray() `.




## Returns




+ ` HH\varray<Tv> ` - an integer-indexed `` array `` containing the values from the
  current ``` ImmSet ```.




## Examples




See [` Set::toValuesArray `](</hack/reference/class/Set/toValuesArray/#examples>) for usage examples.
<!-- HHAPIDOC -->
