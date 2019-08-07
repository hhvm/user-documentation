``` yamlmeta
{
    "name": "firstValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns the first value in the current ` Vector `




``` Hack
public function firstValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The first value in the current `` Vector ``, or ``` null ``` if the
  ```` Vector ```` is empty.




## Examples




The following example gets the first value from ` Vector `. An empty `` Vector `` will return ``` null ``` as its first value.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/firstValue/001-basic-usage.php @@
<!-- HHAPIDOC -->
