``` yamlmeta
{
    "name": "addAllKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Adds the keys of the specified container to the current ` Set ` as new
values




``` Hack
public function addAllKeysOf(
  ?KeyedContainer<Tv, mixed> $container,
): Set<Tv>;
```




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` ?KeyedContainer<Tv, mixed> $container ` - The container with the new keys to add.




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples




This example adds ` string ` keys from a `` Map `` to a ``` Set ``` as its values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/addAllKeysOf/001-string-keys.php @@




This example adds ` int ` keys from a `` Map `` to a ``` Set ``` as its values:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/addAllKeysOf/002-int-keys.php @@
<!-- HHAPIDOC -->
