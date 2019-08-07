``` yamlmeta
{
    "name": "toKeysArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` array ` containing the values from the current `` ImmSet ``




``` Hack
public function toKeysArray(): HH\varray<Tv>;
```




` Set `s don't have keys. So this method just returns the values.




This method is interchangeable with ` toValuesArray() `.




## Returns




+ ` HH\varray<Tv> ` - an integer-indexed `` array `` containing the values from the
  current ``` ImmSet ```.




## Examples




See [` Set::toKeysArray `](</hack/reference/class/Set/toKeysArray/#examples>) for usage examples.
<!-- HHAPIDOC -->
