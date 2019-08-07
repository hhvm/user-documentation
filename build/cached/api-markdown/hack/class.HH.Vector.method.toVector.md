``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Returns a copy of the current ` Vector `




``` Hack
public function toVector(): Vector<Tv>;
```




## Returns




+ ` Vector<Tv> ` - A `` Vector `` that is a copy of the current ``` Vector ```.




## Examples




This example shows how ` toVector() ` returns a copy of `` $v `` (a new ``` Vector ``` object), so mutating this new ```` Vector ```` doesn't affect the original.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toVector/001-basic-usage.php @@




This example shows how ` toVector() ` returns a shallow copy of `` $v `` (a new ``` Vector ``` object containing the same elements)
rather than a deep copy (a new ```` Vector ```` object containing copies of the elements of ````` $v ````` that are themselves objects).




Thus, mutating an element of ` $v ` that is itself an object also mutates the corresponding element of `` $v2 ``, since the element in ``` $v ```
is the same object as the element in ```` $v2 ````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/toVector/002-shallow-copy.php @@
<!-- HHAPIDOC -->
