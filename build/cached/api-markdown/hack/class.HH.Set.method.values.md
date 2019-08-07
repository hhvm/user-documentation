``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Vector ` containing the values of the current `` Set ``




``` Hack
public function values(): Vector<Tv>;
```




This method is interchangeable with ` toVector() ` and `` keys() ``.




## Returns




+ ` Vector<Tv> ` - a `` Vector `` (integer-indexed) containing the values of the
  current ``` Set ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/values/001-basic-usage.php @@
<!-- HHAPIDOC -->
