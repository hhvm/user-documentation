``` yamlmeta
{
    "name": "fromArrays",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing all the values from the specified
`` array ``(s)




``` Hack
public static function fromArrays(
  ...$argv,
): ImmSet<Tv>;
```




## Parameters




+ ` ...$argv `




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` with the values from the passed ``` array ```(s).




## Examples




See [` Set::fromArrays `](</hack/reference/class/Set/fromArrays/#examples>) for usage examples.
<!-- HHAPIDOC -->
