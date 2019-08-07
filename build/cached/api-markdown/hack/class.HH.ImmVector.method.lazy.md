``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns a lazy, access-elements-only-when-needed view of the current
` ImmVector `




``` Hack
public function lazy(): HH\Rx\KeyedIterable<int, Tv>;
```




Normally, memory is allocated for all of the elements of an ` ImmVector `.
With a lazy view, memory is allocated for an element only when needed or
used in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` HH\Rx\KeyedIterable<int, Tv> ` - An integer-keyed `` KeyedIterable `` representing the lazy view into
  the current ``` ImmVector ```.




## Examples




See [` Vector::lazy `](</hack/reference/class/Vector/lazy/#examples>) for usage examples.
<!-- HHAPIDOC -->
