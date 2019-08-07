``` yamlmeta
{
    "name": "firstValue",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns the first value in the current ` Set `




``` Hack
public function firstValue(): ?Tv;
```




## Returns




+ ` ?Tv ` - The first value in the current `` Set ``, or ``` null ``` if the ```` Set ```` is
  empty.




## Examples




The following example gets the first value from a ` Set `. An empty `` Set `` will return ``` null ``` as its first value.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/firstValue/001-basic-usage.php @@
<!-- HHAPIDOC -->
