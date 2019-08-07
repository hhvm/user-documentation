``` yamlmeta
{
    "name": "lastKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns the last "key" in the current ` Set `




``` Hack
public function lastKey(): ?arraykey;
```




Since ` Set `s do not have keys, it returns the last value.




This method is interchangeable with ` lastValue() `.




## Returns




+ ` ?arraykey ` - The last value in the current `` Set ``, or ``` null ``` if the current
  ```` Set ```` is empty.




## Examples




This example shows that ` lastKey ` returns the last value in the `` Set ``. An empty ``` Set ``` will return ```` null ```` as its last key/value.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/lastKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
