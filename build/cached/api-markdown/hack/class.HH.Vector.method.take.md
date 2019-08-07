``` yamlmeta
{
    "name": "take",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the first `` $n `` values of the current
``` Vector ```




``` Hack
public function take(
  int $n,
): Vector<Tv>;
```




The returned ` Vector ` will always be a subset (but not necessarily a
proper subset) of the current `` Vector ``. If ``` $n ``` is greater than the length
of the current ```` Vector ````, the returned ````` Vector ````` will contain all elements of
the current `````` Vector ``````.




` $n ` is 1-based. So the first element is 1, the second 2, etc.




## Parameters




+ ` int $n ` - The last element that will be included in the returned
  `` Vector ``.




## Returns




* ` Vector<Tv> ` - A `` Vector `` that is a subset of the current ``` Vector ``` up to ```` $n ````
  elements.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/take/001-basic-usage.php @@
<!-- HHAPIDOC -->
