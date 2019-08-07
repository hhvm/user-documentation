``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns the current ` ImmVector `




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




Unlike ` Vector `'s `` toVector() `` method, this does not actually return a copy
of the current ``` ImmVector ```. Since ```` ImmVector ````s are immutable, there is no
reason to pay the cost of creating a copy of the current ````` ImmVector `````.




This method is interchangeable with ` immutable() `.




This method is NOT interchangeable with ` values() `. `` values() `` returns a
new ``` ImmVector ``` that is a copy of the current ```` ImmVector ````, and thus incurs
both the cost of copying the current ````` ImmVector `````, and the memory space
consumed by the new `````` ImmVector ``````.  This may be significant, for large
``````` ImmVector ```````s.




## Returns




+ ` ImmVector<Tv> ` - The current `` ImmVector ``.




## Examples




See [` Vector::toImmVector `](</hack/reference/class/Vector/toImmVector/#examples>) for usage examples.
<!-- HHAPIDOC -->
