``` yamlmeta
{
    "name": "contains",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Determines if the specified value is in the current ` ImmSet `




``` Hack
public function contains(
  mixed $val,
): bool;
```




## Parameters




+ ` mixed $val `




## Returns




* ` bool ` - `` true `` if the specified value is present in the current ``` ImmSet ```;
  ```` false ```` otherwise.




## Examples




See [` Set::contains `](</hack/reference/class/Set/contains/#examples>) for usage examples.
<!-- HHAPIDOC -->
