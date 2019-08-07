``` yamlmeta
{
    "name": "add",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Appends a value to the end of the current ` Vector `, assigning it the next
available integer key




``` Hack
public function add(
  Tv $value,
): Vector<Tv>;
```




If you want to overwrite the value for an existing key, use ` set() `.




` $vec->add($v) ` is semantically equivalent to `` $vec[] = $v `` (except that
``` add() ``` returns the current ```` Vector ````).




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




If ` $v ` is an object, future changes to the added element ARE reflected in
`` $v ``, and vice versa.




## Parameters




+ ` Tv $value `




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




The following example adds a single value to the ` Vector ` `` $v `` and also adds multiple values to ``` $v ``` through chaining. Since ```` Vector::add() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $v ` itself, you can chain a bunch of `` add() `` calls together, and that will add all those values to ``` $v ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/add/001-basic-usage.php @@
<!-- HHAPIDOC -->
