``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Vector ` that is the concatenation of the values of the current
`` Set `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): Vector<Tu>;
```




The values of the provided ` Traversable ` is concatenated to the end of the
current `` Set `` to produce the returned ``` Vector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` Set ```.




## Returns




* ` Vector<Tu> ` - The concatenated `` Vector ``.




## Examples




This example creates new ` Set `s by concatenating other `` Traversable ``s. Unlike ``` Set::addAll() ``` this method returns a new ```` Set ```` (not a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>)).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/concat/001-basic-usage.php @@
<!-- HHAPIDOC -->
