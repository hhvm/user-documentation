``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` that is the concatenation of the values of the current
`` Vector `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): Vector<Tu>;
```




The returned ` Vector ` is created from the values of the current `` Vector ``,
followed by the values of the provided ``` Traversable ```.




The returned ` Vector ` is a new object; the current `` Vector `` is unchanged.
Future changes to the current ``` Vector ``` will not affect the returned
```` Vector ````, and future changes to the returned ````` Vector ````` will not affect the
current `````` Vector ``````.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate with the current
  ``` Vector ```.




## Returns




* ` Vector<Tu> ` - A new `` Vector `` containing the values from ``` $traversable ```
  concatenated to the values from the current ```` Vector ````.




## Examples




This example creates new ` Vector `s by concatenating other `` Traversable ``s. Unlike ``` Vector::addAll() ``` this method returns a new ```` Vector ```` (not a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>)).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/concat/001-basic-usage.php @@
<!-- HHAPIDOC -->
