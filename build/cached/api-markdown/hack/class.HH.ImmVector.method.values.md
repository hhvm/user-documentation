``` yamlmeta
{
    "name": "values",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns a new ` ImmVector ` containing the values of the current `` ImmVector ``;
that is, a copy of the current ``` ImmVector ```




``` Hack
public function values(): ImmVector<Tv>;
```




This method is NOT interchangeable with ` toImmVector() ` and `` immutable() ``.
``` toImmVector() ``` and ```` immutable() ```` return the current ````` ImmVector `````, and do
not incur the cost of copying the current `````` ImmVector ``````, or the memory space
consumed by the new ``````` ImmVector ```````.  This may be significant, for large
```````` ImmVector ````````s.




## Returns




+ ` ImmVector<Tv> ` - A new `` ImmVector `` containing the values of the current
  ``` ImmVector ```.




## Examples




See [` Vector::values `](</hack/reference/class/Vector/values/#examples>) for usage examples.
<!-- HHAPIDOC -->
