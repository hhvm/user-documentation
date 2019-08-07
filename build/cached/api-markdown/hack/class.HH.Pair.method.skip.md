``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values after the `` n ``-th element of
the current ``` Pair ```




``` Hack
public function skip(
  int $n,
): ImmVector<mixed>;
```




` n ` is 1-based. So the first element is 1, the second 2, etc. There is no
element 3 in a `` Pair ``, but if you specify an element greater than or equal
to 2, it will just return empty. If you specify 0, it will return all the
elements in the ``` Pair ```.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` ImmVector ```.




## Returns




* ` ImmVector<mixed> ` - An `` ImmVector `` that contains values after the specified ``` n ```-th
  element in the current ```` Pair ````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/skip/001-basic-usage.php @@
<!-- HHAPIDOC -->
