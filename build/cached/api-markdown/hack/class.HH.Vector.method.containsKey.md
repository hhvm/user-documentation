``` yamlmeta
{
    "name": "containsKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Determines if the specified key is in the current ` Vector `




``` Hack
public function containsKey(
  mixed $key,
): bool;
```




## Parameters




+ ` mixed $key `




## Returns




* ` bool ` - `` true `` if the specified key is present in the current ``` Vector ```;
  returns ```` false ```` otherwise.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/containsKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
