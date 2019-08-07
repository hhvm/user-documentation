``` yamlmeta
{
    "name": "lastKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns the last "key" in the current ` ImmSet `




``` Hack
public function lastKey(): ?arraykey;
```




Since ` ImmSet `s do not have keys, it returns the last value.




This method is interchangeable with ` lastValue() `.




## Returns




+ ` ?arraykey ` - The last value in the current `` ImmSet ``, or ``` null ``` if the current
  ```` ImmSet ```` is empty.




## Examples




See [` Set::lastKey `](</hack/reference/class/Set/lastKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
