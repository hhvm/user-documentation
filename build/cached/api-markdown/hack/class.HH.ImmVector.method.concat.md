``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Returns an ` ImmVector ` that is the concatenation of the values of the
current `` ImmVector `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): ImmVector<Tu>;
```




The returned ` ImmVector ` is created from the values of the current
`` ImmVector ``, followed by the values of the provided ``` Traversable ```.




The returned ` ImmVector ` is a new object; the current `` ImmVector `` is
unchanged.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` ImmVector ```.




## Returns




* ` ImmVector<Tu> ` - A new `` ImmVector `` containing the values from ``` $traversable ```
  concatenated to the values from the current ```` ImmVector ````.




## Examples




See [` Vector::concat `](</hack/reference/class/Vector/concat/#examples>) for usage examples.
<!-- HHAPIDOC -->
