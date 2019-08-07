``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a deep copy of the current ` Set `




``` Hack
public function toSet(): this<Tv>;
```




## Returns




+ ` this<Tv> ` - a `` Set `` that is a deep copy of the current ``` Set ```.




## Examples




This example shows that ` toSet ` returns a deep copy of the `` Set ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toSet/001-basic-usage.php @@
<!-- HHAPIDOC -->
