``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` where each element is a `` Pair `` that combines each
element of the current ``` Pair ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
):     ImmVector<Pair<mixed, Tu>, \HH\Pair<mixed, Tu>>;
```




If the number of elements of the current ` Pair ` are not equal to the
number of elements in the `` Traversable ``, then only the combined elements
up to and including the final element of the one with the least number of
elements is included.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` Pair ```.




## Returns




* ` ImmVector<Pair<mixed, Tu>, \HH\Pair<mixed, Tu>> ` - The `` ImmVector `` that combines the values of the current ``` Pair ```
  with the provided ```` Traversable ````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/zip/001-basic-usage.php @@
<!-- HHAPIDOC -->
