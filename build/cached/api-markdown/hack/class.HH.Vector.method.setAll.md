``` yamlmeta
{
    "name": "setAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




For every element in the provided ` Traversable `, stores a value into the
current `` Vector `` associated with each key, overwriting the previous value
associated with the key




``` Hack
public function setAll(
  ?KeyedTraversable<int, Tv> $iterable,
): Vector<Tv>;
```




If a key is not present the current ` Vector ` that is present in the
`` Traversable ``, an exception is thrown. If you want to add a value even if a
key is not present, use ``` addAll() ```.




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Parameters




+ ` ?KeyedTraversable<int, Tv> $iterable `




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




This example shows how ` setAll() ` can be used with any `` KeyedTraversable ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/setAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
