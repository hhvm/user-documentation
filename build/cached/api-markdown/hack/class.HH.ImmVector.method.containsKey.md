``` yamlmeta
{
    "name": "containsKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Determines if the specified key is in the current ` ImmVector `




``` Hack
public function containsKey(
  mixed $key,
): bool;
```




## Parameters




+ ` mixed $key `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current
  ``` ImmVector ```; ```` false ```` otherwise.




## Examples




See [` Vector::containsKey `](</hack/reference/class/Vector/containsKey/#examples>) for usage examples.
<!-- HHAPIDOC -->
