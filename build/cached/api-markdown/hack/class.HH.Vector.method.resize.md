``` yamlmeta
{
    "name": "resize",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Resize the current ` Vector `




``` Hack
public function resize(
  int $sz,
  Tv $value,
): void;
```




Resize the current ` Vector ` to contain `` $sz `` elements. If ``` $sz ``` is smaller
than the current size of the current ```` Vector ````, elements are removed from
the end of the current ````` Vector `````. If `````` $sz `````` is greater than the current size
of the current ``````` Vector ```````, the current ```````` Vector ```````` is extended by appending as
many copies of ````````` $value ````````` as needed to reach a size of `````````` $sz `````````` elements.




` $value ` can be `` null ``.




If ` $sz ` is less than zero, an exception is thrown.




## Parameters




+ ` int $sz ` - The desired size of the current `` Vector ``.
+ ` Tv $value ` - The value to use as the filler if we are increasing the
  size of the current `` Vector ``.




## Returns




* ` void `




## Examples




This example shows how ` resize ` can be used to decrease and increase the size of a `` Vector ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/resize/001-basic-usage.php @@
<!-- HHAPIDOC -->
