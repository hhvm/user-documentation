``` yamlmeta
{
    "name": "fromKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Creates a ` Set ` from the keys of the specified container




``` Hack
public static function fromKeysOf<Tk as arraykey>(
  ?KeyedContainer<Tk, mixed> $container,
): Set<Tk>;
```




The keys of the container will be the values of the ` Set `.




## Parameters




+ ` ?KeyedContainer<Tk, mixed> $container ` - The container with the keys used to create the `` Set ``.




## Returns




* ` Set<Tk> ` - A `` Set `` built from the keys of the specified container.




## Examples




This example creates new ` Set `s from a string-keyed `` Map `` and associative array:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/fromKeysOf/001-string-keys.php @@




This example creates new ` Set `s from an int-keyed `` Map `` and associative array:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/fromKeysOf/002-int-keys.php @@
<!-- HHAPIDOC -->
