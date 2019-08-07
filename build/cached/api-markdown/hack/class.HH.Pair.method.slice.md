``` yamlmeta
{
    "name": "slice",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns a subset of the current ` Pair ` starting from a given key up to,
but not including, the element at the provided length from the starting
key




``` Hack
public function slice(
  int $start,
  int $len,
): ImmVector<mixed>;
```




` $start ` is 0-based. `` $len `` is 1-based. So ``` slice(0, 2) ``` would return the
elements at key 0 and 1 (all of the current ```` Pair ```` elements).




## Parameters




+ ` int $start ` - The starting key of the current `` Pair `` to begin the
  returned ``` ImmVector ```.
+ ` int $len ` - The length of the returned `` ImmVector ``.




## Returns




* ` ImmVector<mixed> ` - An `` ImmVector `` with values from the current ``` Pair ``` starting at
  ```` $start ```` up to but not including the element ````` $start + $len `````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Pair/slice/001-basic-usage.php @@
<!-- HHAPIDOC -->
