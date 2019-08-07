``` yamlmeta
{
    "name": "skip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values after the `` $n ``-th element of the
current ``` Vector ```




``` Hack
public function skip(
  int $n,
): Vector<Tv>;
```




The returned ` Vector ` will always be a subset (but not necessarily a
proper subset) of the current `` Vector ``. If ``` $n ``` is greater than or equal to
the length of the current ```` Vector ````, the returned ````` Vector ````` will contain no
elements. If `````` $n `````` is negative, the returned ``````` Vector ``````` will contain all
elements of the current ```````` Vector ````````.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element to be skipped; the `` $n+1 `` element will be the
  first one in the returned ``` Vector ```.




## Returns




* ` Vector<Tv> ` - A `` Vector `` that is a subset of the current ``` Vector ``` containing
  values after the specified ```` $n ````-th element.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/skip/001-basic-usage.php @@
<!-- HHAPIDOC -->
