``` yamlmeta
{
    "name": "addAllKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Adds the keys of the specified container to the current ` Vector `




``` Hack
public function addAllKeysOf(
  ?KeyedContainer<Tv, mixed> $container,
): Vector<Tv>;
```




For every key in the provided ` KeyedContainer `, append that key into
the current `` Vector ``, assigning the next available integer key for each.




Future changes made to the current ` Vector ` ARE reflected in the
returned `` Vector ``, and vice-versa.




## Parameters




+ ` ?KeyedContainer<Tv, mixed> $container ` - The `` KeyedContainer `` with the new keys to add.




## Returns




* ` Vector<Tv> ` - Returns itself.




## Examples




This example adds ` string ` keys from a `` Map `` to a ``` Vector ``` as its values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/addAllKeysOf/001-string-keys.php @@




This example adds ` int ` keys from a `` Map `` to a ``` Vector ``` as its values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/addAllKeysOf/002-int-keys.php @@
<!-- HHAPIDOC -->
