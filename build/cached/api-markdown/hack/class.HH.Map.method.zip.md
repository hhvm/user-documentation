``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Map ` where each value is a `` Pair `` that combines the value
of the current ``` Map ``` and the provided ```` Traversable ````




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): Map<Tk, Pair<Tv, Tu>>;
```




If the number of values of the current ` Map ` are not equal to the number
of elements in the `` Traversable ``, then only the combined elements up to
and including the final element of the one with the least number of
elements is included.




The keys associated with the current ` Map ` remain unchanged in the
returned `` Map ``.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` Map ```.




## Returns




* ` Map<Tk, Pair<Tv, Tu>> ` - The `` Map `` that combines the values of the current ``` Map ``` with
  the provided ```` Traversable ````.




## Examples




This example shows how ` zip ` combines the values of the `` Map `` and another ``` Traversable ```. The resulting ```` Map ```` ````` $labeled_colors ````` has three elements because `````` $labels `````` doesn't have a fourth element to pair with ``````` $m ```````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/zip/001-basic-usage.php @@
<!-- HHAPIDOC -->
