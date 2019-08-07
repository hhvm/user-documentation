``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns a subset of the current ` ImmVector ` starting from a given key up
to, but not including, the element at the provided length from the
starting key




``` Hack
public function slice(
  int $start,
  int $len,
): ImmVector<Tv>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1.




The returned ` ImmVector ` will always be a subset (but not necessarily a
proper subset) of the current `` ImmVector ``. If ``` $start ``` is greater than or
equal to the length of the current ```` Vector ````, the returned ````` Vector ````` will
contain no elements.  If `````` $start `````` + ``````` $len ``````` is greater than or equal to the
length of the current ```````` Vector ````````, the returned ````````` Vector ````````` will contain the
elements from `````````` $start `````````` to the end of the current ``````````` Vector ```````````.




If either ` $start ` or `` $len `` is negative, an exception is thrown.




## Parameters




+ ` int $start ` - The starting key of the current `` ImmVector `` at which to
  begin the returned ``` ImmVector ```.
+ ` int $len ` - The length of the returned `` ImmVector ``.




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` that is a subset of the current ``` ImmVector ```
  starting at ```` $start ```` up to but not including the element
  ````` $start + $len `````.




## Examples




See [` Vector::slice `](</hack/reference/class/Vector/slice/#examples>) for usage examples.
<!-- HHAPIDOC -->
