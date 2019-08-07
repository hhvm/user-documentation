``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns the last value in the current ` ImmSet `




``` Hack
public function lastValue(): ?Tv;
```




This method is interchangeable with ` lastKey() `.




## Returns




+ ` ?Tv ` - The last value in the current `` ImmSet ``, or ``` null ``` if the current
  ```` ImmSet ```` is empty.




## Examples




See [` Set::lastValue `](</hack/reference/class/Set/lastValue/#examples>) for usage examples.
<!-- HHAPIDOC -->
