``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns the last value in the current ` Set `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` Set ``, or ``` null ``` if the current
  ```` Set ```` is empty.




## Examples




This example shows how ` lastValue() ` can be used even when a `` Set `` may be empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/lastValue/001-basic-usage.php @@
<!-- HHAPIDOC -->
