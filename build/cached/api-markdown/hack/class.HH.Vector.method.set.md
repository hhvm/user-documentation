``` yamlmeta
{
    "name": "set",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Stores a value into the current ` Vector ` with the specified key,
overwriting the previous value associated with the key




``` Hack
public function set(
  int $key,
  Tv $value,
): Vector<Tv>;
```




If the key is not present, an exception is thrown. If you want to add
a value even if the key is not present, use ` add() `.




` $vec->set($k,$v) ` is semantically equivalent to `` $vec[$k] = $v `` (except
that ``` set() ``` returns the current ```` Vector ````).




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Parameters




+ ` int $key `
+ ` Tv $value `




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




Since ` Vector::set() ` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $v ` itself, you can chain a bunch of `` set() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/set/001-basic-usage.php @@
<!-- HHAPIDOC -->
