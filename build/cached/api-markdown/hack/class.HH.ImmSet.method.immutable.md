``` yamlmeta
{
    "name": "immutable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an immutable copy (` ImmSet `) of the current `` ImmSet ``




``` Hack
public function immutable(): ImmSet<Tv>;
```




This method is interchangeable with ` toImmSet() `.




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` that is a copy of the current ``` ImmSet ```.




## Examples




See [` Set::immutable `](</hack/reference/class/Set/immutable/#examples>) for usage examples.
<!-- HHAPIDOC -->
