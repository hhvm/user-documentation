``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns the first "key" in the current ` ImmSet `




``` Hack
public function firstKey(): ?arraykey;
```




Since ` ImmSet `s do not have keys, it returns the first value.




This method is interchangeable with ` firstValue() `.




## Returns




+ ` ?arraykey ` - The first value in the current `` ImmSet ``, or ``` null ``` if the
  current ```` ImmSet ```` is empty.




## Examples




See [` Set::firstKey `](</hack/reference/class/Set/firstKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
