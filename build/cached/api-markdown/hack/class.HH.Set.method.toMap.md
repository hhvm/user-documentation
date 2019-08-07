``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Map ` based on the values of the current `` Set ``




``` Hack
public function toMap(): Map<arraykey, Tv>;
```




Each key of the ` Map ` will be the same as its value.




## Returns




+ ` Map<arraykey, Tv> ` - a `` Map `` that that contains the values of the current ``` Set ```, with
  each key of the ```` Map ```` being the same as its value.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
