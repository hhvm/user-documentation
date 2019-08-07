``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an immutable map (` ImmMap `) based on the values of the current
`` Set ``




``` Hack
public function toImmMap(): ImmMap<arraykey, Tv>;
```




Each key of the ` Map ` will be the same as its value.




## Returns




+ ` ImmMap<arraykey, Tv> ` - an `` ImmMap `` that that contains the values of the current ``` Set ```,
  with each key of the Map being the same as its value.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toImmMap/001-basic-usage.php @@
<!-- HHAPIDOC -->
