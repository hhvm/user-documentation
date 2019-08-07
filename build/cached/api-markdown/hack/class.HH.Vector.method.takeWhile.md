``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values of the current `` Vector `` up to but
not including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $callback,
): Vector<Tv>;
```




That is, takes the continuous prefix of values in
the current ` Vector ` for which the specified callback returns `` true ``.




The returned ` Vector ` will always be a subset (but not necessarily a
proper subset) of the current `` Vector ``.




## Parameters




+ ` callable $callback `




## Returns




* ` Vector<Tv> ` - A `` Vector `` that is a subset of the current ``` Vector ``` up until the
  callback returns ```` false ````.




## Examples




This example shows how ` takeWhile ` can be used to create a new `` Vector `` by taking elements from the beginning of an existing ``` Vector ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/takeWhile/001-basic-usage.php @@
<!-- HHAPIDOC -->
