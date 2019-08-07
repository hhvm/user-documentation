``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an Iterable view of the current ` ImmSet `




``` Hack
public function items(): HH\Rx\Iterable<Tv>;
```




The ` Iterable ` returned is one that produces the values from the current
`` ImmSet ``.




## Returns




+ ` HH\Rx\Iterable<Tv> ` - The `` Iterable `` view of the current ``` ImmSet ```.




## Examples




See [` Set::items `](</hack/reference/class/Set/items/#examples>) for usage examples.
<!-- HHAPIDOC -->
