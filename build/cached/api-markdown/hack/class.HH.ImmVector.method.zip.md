``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` where each element is a `` Pair `` that combines the
element of the current ``` ImmVector ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     ImmVector<Pair<Tv, Tu>>;
```




If the number of elements of the current ` ImmVector ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` ImmVector ```.




## Returns




* ` ImmVector<Pair<Tv, Tu>> ` - An `` ImmVector `` that combines the values of the current
  ``` ImmVector ``` with the provided ```` Traversable ````.




## Examples




See [` Vector::zip `](</hack/reference/class/Vector/zip/#examples>) for usage examples.
<!-- HHAPIDOC -->
