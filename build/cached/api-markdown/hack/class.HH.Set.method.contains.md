``` yamlmeta
{
    "name": "contains",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Determines if the specified value is in the current ` Set `




``` Hack
public function contains(
  mixed $val,
): bool;
```




## Parameters




+ ` mixed $val `




## Returns




* ` bool ` - `` true `` if the specified value is present in the current ``` Set ```;
  ```` false ```` otherwise.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/contains/001-basic-usage.php @@
<!-- HHAPIDOC -->
