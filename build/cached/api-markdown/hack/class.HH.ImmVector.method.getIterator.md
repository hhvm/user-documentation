``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an iterator that points to beginning of the current ` ImmVector `




``` Hack
public function getIterator(): HH\Rx\KeyedIterator<int, Tv>;
```




## Returns




+ ` HH\Rx\KeyedIterator<int, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current
  ``` ImmVector ```.




## Examples




See [` Vector::getIterator `](</hack/reference/class/Vector/getIterator/#examples>) for usage examples.
<!-- HHAPIDOC -->
