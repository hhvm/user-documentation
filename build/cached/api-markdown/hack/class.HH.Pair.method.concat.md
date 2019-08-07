``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` that is the concatenation of the values of the
current `` Pair `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super mixed>(
  Traversable<mixed, Tu> $traversable,
):     ImmVector<mixed, Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` Pair `` to produce the returned ``` ImmVector ```.




## Parameters




+ ` Traversable<mixed, Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` Pair ```.




## Returns




* ` ImmVector<mixed, Tu> ` - The concatenated `` ImmVector ``.




## Examples




This example creates a new ` ImmVector ` by concatenating a `` Traversable `` with the values in the ``` Pair ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/concat/001-basic-usage.php @@
<!-- HHAPIDOC -->
