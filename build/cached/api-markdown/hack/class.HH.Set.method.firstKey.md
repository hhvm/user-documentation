``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns the first "key" in the current ` Set `




``` Hack
public function firstKey(): ?arraykey;
```




Since ` Set `s do not have keys, it returns the first value.




This method is interchangeable with ` firstValue() `.




## Returns




+ ` ?arraykey ` - The first value in the current `` Set ``, or ``` null ``` if the ```` Set ```` is
  empty.




## Examples




This example shows that ` firstKey ` returns the first value in the `` Set ``. An empty ``` Set ``` will return ```` null ```` as its first key.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/firstKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
