``` yamlmeta
{
    "name": "toValuesArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an ` array ` containing the values from the current `` Set ``




``` Hack
public function toValuesArray(): HH\varray<Tv>;
```




This method is interchangeable with ` toKeysArray() `.




## Returns




+ ` HH\varray<Tv> ` - an integer-indexed `` array `` containing the values from the
  current ``` Set ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toValuesArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
