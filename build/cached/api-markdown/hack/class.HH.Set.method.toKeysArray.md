``` yamlmeta
{
    "name": "toKeysArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an ` array ` containing the values from the current `` Set ``




``` Hack
public function toKeysArray(): HH\varray<Tv>;
```




` Set `s don't have keys. So this method just returns the values.




This method is interchangeable with ` toValuesArray() `.




## Returns




+ ` HH\varray<Tv> ` - an integer-indexed `` array `` containing the values from the
  current ``` Set ```.




## Examples




This example shows that ` toKeysArray ` is the same as `` toValuesArray `` because ``` Set ```s don't have keys:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toKeysArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
