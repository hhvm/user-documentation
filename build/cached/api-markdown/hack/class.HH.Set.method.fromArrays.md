``` yamlmeta
{
    "name": "fromArrays",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Set ` containing all the values from the specified `` array ``(s)




``` Hack
public static function fromArrays(
  ...$argv,
): Set<Tv>;
```




## Parameters




+ ` ...$argv `




## Returns




* ` Set<Tv> ` - A `` Set `` with the values from the passed ``` array ```(s).




## Examples




This example shows that duplicate values in the input arrays only appear once in the final ` Set `:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/fromArrays/001-basic-usage.php @@
<!-- HHAPIDOC -->
