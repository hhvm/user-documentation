``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an iterator that points to beginning of the current ` ImmSet `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<arraykey, Tv>;
```




The keys and values when iterating through the ` KeyedIterator ` will be
identical since `` ImmSet ``s have no keys, the values are used as keys.




## Returns




+ ` HH\Rx\KeyedIterator<arraykey, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current
  ``` ImmSet ```.




## Examples




See [` Set::getIterator `](</hack/reference/class/Set/getIterator/#examples>) for usage examples.
<!-- HHAPIDOC -->
