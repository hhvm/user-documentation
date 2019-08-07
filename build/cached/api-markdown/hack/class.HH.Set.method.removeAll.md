``` yamlmeta
{
    "name": "removeAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Removes the values in the current ` Set ` that are also in the `` Traversable ``




``` Hack
public function removeAll(
  Traversable<Tv> $iterable,
): Set<Tv>;
```




If a value in the ` Traversable ` doesn't exist in the current `` Set ``, that
value in the ``` Traversable ``` is ignored.




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` Traversable<Tv> $iterable `




## Returns




* ` Set<Tv> ` - Returns itself.




## Examples




This example removes multiple values from a ` Set ` and shows that the list of values to be removed can contain duplicates:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/removeAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
