``` yamlmeta
{
    "name": "firstValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns the first value in the current ` ImmSet `




``` Hack
public function firstValue(): ?Tv;
```




This method is interchangeable with ` firstKey() `.




## Returns




+ ` ?Tv ` - The first value in the current `` ImmSet ``, or ``` null ``` if the
  current ```` ImmSet ```` is empty.




## Examples




See [` Set::firstValue `](</hack/reference/class/Set/firstValue/#examples>) for usage examples.
<!-- HHAPIDOC -->
