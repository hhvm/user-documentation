``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the first `` $n `` values of the current
``` ImmVector ```




``` Hack
public function take(
  int $n,
): ImmVector<Tv>;
```




The returned ` ImmVector ` will always be a subset (but not necessarily a
proper subset) of the current `` ImmVector ``. If ``` $n ``` is greater than the
length of the current ```` ImmVector ````, the returned ````` ImmVector ````` will contain
all elements of the current `````` ImmVector ``````.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` ImmVector ``.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` that is a subset of the current ``` ImmVector ``` up to
  ```` $n ```` elements.




## Examples




See [` Vector::take `](</hack/reference/class/Vector/take/#examples>) for usage examples.
<!-- HHAPIDOC -->
