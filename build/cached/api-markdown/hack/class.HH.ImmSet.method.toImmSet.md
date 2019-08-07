``` yamlmeta
{
    "name": "toImmSet",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an immutable copy (` ImmSet `) of the current `` ImmSet ``




``` Hack
public function toImmSet(): ImmSet<Tv>;
```




This function is interchangeable with ` immutable() `.




## Returns




+ ` ImmSet<Tv> ` - an `` ImmSet `` that is a copy of the current ``` ImmSet ```.




## Examples




See [` Set::toImmSet `](</hack/reference/class/Set/toImmSet/#examples>) for usage examples.
<!-- HHAPIDOC -->
