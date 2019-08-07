``` yamlmeta
{
    "name": "toSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns a mutable copy (` Set `) of the current `` ImmSet ``




``` Hack
public function toSet(): Set<Tv>;
```




## Returns




+ ` Set<Tv> ` - a `` Set `` that is a copy of the current ``` ImmSet ```.




## Examples




See [` Set::toSet `](</hack/reference/class/Set/toSet/#examples>) for usage examples.
<!-- HHAPIDOC -->
