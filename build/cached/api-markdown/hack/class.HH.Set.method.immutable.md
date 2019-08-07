``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an immutable (` ImmSet `), deep copy of the current `` Set ``




``` Hack
public function immutable(): ImmSet<Tv>;
```




This method is interchangeable with ` toImmSet() `.




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` that is a deep copy of the current ``` Set ```.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/immutable/001-basic-usage.php @@
<!-- HHAPIDOC -->
