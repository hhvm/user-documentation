``` yamlmeta
{
    "name": "firstKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the first key in the current ` Vector `




``` Hack
public function firstKey(): ?int;
```




## Returns




+ ` ?int ` - The first key (an integer) in the current `` Vector ``, or ``` null ``` if
  the ```` Vector ```` is empty.




## Examples




The following example gets the first key from ` Vector `. An empty `` Vector `` will return ``` null ``` as its first key.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/firstKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
