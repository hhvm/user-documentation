``` yamlmeta
{
    "name": "concat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Returns a ` Vector ` that is the concatenation of the values of the current
`` Map `` and the values of the provided ``` Traversable ```




``` Hack
public function concat<Tu super Tv>(
  Traversable<Tu> $traversable,
): Vector<Tu>;
```




The provided ` Traversable ` is concatenated to the end of the current `` Map ``
to produce the returned ``` Vector ```.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to concatenate to the current
  ``` Map ```.




## Returns




* ` Vector<Tu> ` - The integer-indexed concatenated `` Vector ``.




## Examples




This example creates new ` Vector `s by concatenating the values in a `` Map `` with ``` Traversable ```s:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/concat/001-basic-usage.php @@
<!-- HHAPIDOC -->
