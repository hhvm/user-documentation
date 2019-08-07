``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` where each element is a `` Pair `` that combines the
element of the current ``` Vector ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): Vector<Pair<Tv, Tu>>;
```




If the number of elements of the ` Vector ` are not equal to the number of
elements in the `` Traversable ``, then only the combined elements up to and
including the final element of the one with the least number of elements
is included.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` Vector ```.




## Returns




* ` Vector<Pair<Tv, Tu>> ` - A `` Vector `` that combines the values of the current ``` Vector ```
  with the provided ```` Traversable ````.




## Examples




This example shows how ` zip ` combines the values of the `` Vector `` and another ``` Traversable ```. The resulting ```` Vector ```` ````` $labeled_colors ````` has three elements because `````` $labels `````` doesn't have a fourth element to pair with ``````` $v ```````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/zip/001-basic-usage.php @@
<!-- HHAPIDOC -->
