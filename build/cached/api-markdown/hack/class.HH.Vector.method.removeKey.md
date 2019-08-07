``` yamlmeta
{
    "name": "removeKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Removes the key/value pair with the specified key from the current
` Vector `




``` Hack
public function removeKey(
  int $key,
): Vector<Tv>;
```




This will cause elements with higher keys to be assigned a new key that is
one less than their previous key.  That is, values with keys ` $k + 1 ` to
`` n - 1 `` will be given new keys ``` $k ``` to ```` n - 2 ````, where n is the length of
the current ````` Vector ````` before the call to `````` removeKey() ``````.




If ` $k ` is negative, or `` $k `` is greater than the largest key in the current
``` Vector ```, no changes are made.




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Parameters




+ ` int $key `




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




Since ` Vector::removeKey() ` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $v ` itself, you can chain a bunch of `` removeKey() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/removeKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
