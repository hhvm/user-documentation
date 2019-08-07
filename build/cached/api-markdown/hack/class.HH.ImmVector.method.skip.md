``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` containing the values after the `` $n ``-th element of
the current ``` ImmVector ```




``` Hack
public function skip(
  int $n,
): ImmVector<Tv>;
```




The returned ` ImmVector ` will always be a subset (but not necessarily a
proper subset) of the current `` ImmVector ``. If ``` $n ``` is greater than or equal
to the length of the current ```` ImmVector ````, the returned ````` ImmVector ````` will
contain no elements. If `````` $n `````` is negative, the returned ``````` ImmVector ``````` will
contain all elements of the current ```````` ImmVector ````````.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ImmVector ```.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` that is a subset of the current ``` ImmVector ```
  containing values after the specified ```` $n ````-th element.




## Examples




See [` Vector::skip `](</hack/reference/class/Vector/skip/#examples>) for usage examples.
<!-- HHAPIDOC -->
