``` yamlmeta
{
    "name": "pop",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Remove the last element of the current ` Vector ` and return it




``` Hack
public function pop(): Tv;
```




This function throws an exception if the current ` Vector ` is empty.




The current ` Vector ` will have `` n - 1 `` elements after this operation, where
``` n ``` is the number of elements in the current ```` Vector ```` prior to the call to
````` pop() `````.




## Returns




+ ` Tv ` - The value of the last element.




## Examples




This example shows that ` pop() ` returns the last element and removes it from the `` Vector ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/pop/001-basic-usage.php @@




This example shows that trying to ` pop ` from an empty `` Vector `` will throw an exception:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/pop/002-throw-exception.php @@
<!-- HHAPIDOC -->
