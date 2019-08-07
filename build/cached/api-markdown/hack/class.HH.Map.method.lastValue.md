``` yamlmeta
{
    "name": "lastValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns the last value in the current ` Map `




``` Hack
public function lastValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The last value in the current `` Map ``, or ``` null ``` if the ```` Map ```` is
  empty.




## Examples




This example shows how ` lastValue() ` can be used even when a `` Map `` may be empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/lastValue/001-basic-usage.php @@
<!-- HHAPIDOC -->
