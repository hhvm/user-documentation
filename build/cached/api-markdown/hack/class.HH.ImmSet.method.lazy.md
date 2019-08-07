``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns a lazy, access elements only when needed view of the current
` ImmSet `




``` Hack
public function lazy(): HH\Rx\KeyedIterable<arraykey, Tv>;
```




Normally, memory is allocated for all of the elements of an ` ImmSet `. With
a lazy view, memory is allocated for an element only when needed or used
in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` HH\Rx\KeyedIterable<arraykey, Tv> ` - an `` KeyedIterable `` representing the lazy view into the current
  ``` ImmSet ```, where the keys are the same as the values.




## Examples




See [` Set::lazy `](</hack/reference/class/Set/lazy/#examples>) for usage examples.
<!-- HHAPIDOC -->
