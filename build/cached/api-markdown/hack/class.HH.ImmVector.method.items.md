``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` Iterable ` view of the current `` ImmVector ``




``` Hack
public function items(): HH\Rx\Iterable<Tv>;
```




The ` Iterable ` returned is one that produces the values from the current
`` ImmVector ``.




## Returns




+ ` HH\Rx\Iterable<Tv> ` - The `` Iterable `` view of the current ``` ImmVector ```.




## Examples




See [` Vector::items `](</hack/reference/class/Vector/items/#examples>) for usage examples.
<!-- HHAPIDOC -->
