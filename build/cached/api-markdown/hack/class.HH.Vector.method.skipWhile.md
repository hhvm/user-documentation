``` yamlmeta
{
    "name": "skipWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a ` Vector ` containing the values of the current `` Vector `` starting
after and including the first value that produces ``` false ``` when passed to
the specified callback




``` Hack
public function skipWhile(
  callable $fn,
): Vector<Tv>;
```




That is, skips the continuous prefix of values in
the current ` Vector ` for which the specified callback returns `` true ``.




The returned ` Vector ` will always be a subset (but not necessarily a
proper subset) of the current `` Vector ``.




## Parameters




+ ` callable $fn ` - The callback used to determine the starting element for the
  returned `` Vector ``.




## Returns




* ` Vector<Tv> ` - A `` Vector `` that is a subset of the current ``` Vector ``` starting
  with the value for which the callback first returns ```` false ````.




## Examples




This example shows how ` skipWhile ` can be used to create a new `` Vector `` by skipping elements at the beginning of an existing ``` Vector ```:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/skipWhile/001-basic-usage.php @@
<!-- HHAPIDOC -->
