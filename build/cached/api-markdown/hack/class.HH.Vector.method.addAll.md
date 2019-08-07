``` yamlmeta
{
    "name": "addAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




For every element in the provided ` Traversable `, append a value into this
`` Vector ``, assigning the next available integer key for each




``` Hack
public function addAll(
  ?Traversable<Tv> $iterable,
): Vector<Tv>;
```




If you want to overwrite the values for existing keys, use ` setAll() `.




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




The following example adds a collection of values to the ` Vector ` `` $v `` and also adds multiple collections of values to ``` $v ``` through chaining. Since ```` Vector::addAll() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $v ` itself, you can chain a bunch of `` addAll() `` calls together, and that will add all those collection of values to ``` $v ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/addAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
