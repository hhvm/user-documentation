``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns a ` Vector ` containing the elemnts of the current `` ImmVector ``




``` Hack
public function toVector(): Vector<Tv>;
```




The returned ` Vector ` will, of course, be mutable.




## Returns




+ ` Vector<Tv> ` - A `` Vector `` with the elements of the current ``` ImmVector ```.




## Examples




See [` Vector::toVector `](</hack/reference/class/Vector/toVector/#examples>) for usage examples.
<!-- HHAPIDOC -->
