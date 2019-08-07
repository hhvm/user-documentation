``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Vector ` of the current `` Set `` values




``` Hack
public function toVector(): Vector<Tv>;
```




## Returns




+ ` Vector<Tv> ` - a `` Vector `` (integer-indexed) that contains the values of the
  current ``` Set ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
