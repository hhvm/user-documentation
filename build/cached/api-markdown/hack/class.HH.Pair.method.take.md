``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the first `` n `` values of the current
``` Pair ```




``` Hack
public function take(
  int $n,
): ImmVector<mixed>;
```




` n ` is 1-based. So the first element is 1, the second 2. There is no
element 3 in a `` Pair ``, but if you specify an element greater than 2, it
will just return all elements in the ``` Pair ```.




## Parameters




+ ` int $n ` - The last element that will be included in the current `` Pair ``.




## Returns




* ` ImmVector<mixed> ` - An `` ImmVector `` containing the first ``` n ``` values of the current
  ```` Pair ````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/take/001-basic-usage.php @@
<!-- HHAPIDOC -->
