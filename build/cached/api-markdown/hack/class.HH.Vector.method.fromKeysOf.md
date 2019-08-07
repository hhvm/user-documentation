``` yamlmeta
{
    "name": "fromKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Creates a ` Vector ` from the keys of the specified container




``` Hack
public static function fromKeysOf<Tk as arraykey>(
  ?KeyedContainer<Tk, mixed> $container,
): Vector<Tk>;
```




Every key in the provided ` KeyedContainer ` will appear sequentially in the
returned `` Vector ``, with the next available integer key assigned to each.




## Parameters




+ ` ?KeyedContainer<Tk, mixed> $container ` - The container with the keys used to create the
  `` Vector ``.




## Returns




* ` Vector<Tk> ` - A `` Vector `` built from the keys of the specified container.




## Examples




This example adds ` string ` keys from a `` Map `` to a ``` Vector ``` as its values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/fromKeysOf/001-string-keys.php @@




This example creates new ` Vector `s from an int-keyed `` Map `` and an associative array:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/fromKeysOf/002-int-keys.php @@
<!-- HHAPIDOC -->
