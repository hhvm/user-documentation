``` yamlmeta
{
    "name": "firstValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns the first value in the current ` Map `




``` Hack
public function firstValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The first value in the current `` Map ``,  or ``` null ``` if the ```` Map ```` is
  empty.




## Examples




The following example gets the first value from a ` Map `. An empty `` Map `` will return ``` null ``` as its first value.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/firstValue/001-basic-usage.php @@
<!-- HHAPIDOC -->
