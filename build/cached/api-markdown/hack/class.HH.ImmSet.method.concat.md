``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmVector ` that is the concatenation of the values of the
current `` ImmSet `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): ImmVector<Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` ImmSet `` to produce the returned ``` ImmVector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` ImmSet ```.




## Returns




* ` ImmVector<Tu> ` - The concatenated `` ImmVector ``.




## Examples




See [` Set::concat `](</hack/reference/class/Set/concat/#examples>) for usage examples.
<!-- HHAPIDOC -->
