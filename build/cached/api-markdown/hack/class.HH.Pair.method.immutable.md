``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an immutable version of this collection




``` Hack
public function immutable(): this;
```




Because a ` Pair ` is immutable by default, this just returns the current
object.




## Returns




+ ` this ` - this `` Pair ``
<!-- HHAPIDOC -->
