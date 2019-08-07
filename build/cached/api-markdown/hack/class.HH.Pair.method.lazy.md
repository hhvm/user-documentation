``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns a lazy, access elements only when needed view of the current
` Pair `




``` Hack
public function lazy(): HH\Rx\KeyedIterable<int, mixed>;
```




Normally, memory is allocated for all of the elements of the ` Pair `.
With a lazy view, memory is allocated for an element only when needed or
used in a calculation like in `` map() `` or ``` filter() ```.




That said, ` Pair `s only have two elements. So the performance impact on
a `` Pair `` will be not be noticeable in the real world.




## Returns




+ ` HH\Rx\KeyedIterable<int, mixed> ` - an integer-keyed KeyedIterable representing the lazy view into
  the current `` Pair ``.
<!-- HHAPIDOC -->
