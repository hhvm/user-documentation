``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an ` array ` containing the values from the current `` Set ``




``` Hack
public function toArray(): HH\array<arraykey, Tv>;
```




For the returned ` array `, each key is the same as its associated value.




## Returns




+ ` HH\array<arraykey, Tv> ` - an `` array `` containing the values from the current ``` Set ```, where
  each key of the ```` array ```` are the same as each value.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toArray/001-basic-usage.php @@
<!-- HHAPIDOC -->
