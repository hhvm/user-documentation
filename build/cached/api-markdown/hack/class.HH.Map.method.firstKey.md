``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns the first key in the current ` Map `




``` Hack
public function firstKey(): ?Tk;
```




## Returns




+ ` ?Tk ` - The first key in the current `` Map ``, or ``` null ``` if the ```` Map ```` is
  empty.




## Examples




The following example gets the first key from ` Map `. An empty `` Map `` will return ``` null ``` as its first key.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/firstKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
