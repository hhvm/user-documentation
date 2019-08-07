``` yamlmeta
{
    "name": "retainWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Alters the current ` Set ` so that it only contains the values that meet a
supplied condition on its "keys" and values




``` Hack
public function retainWithKey(
  callable $callback,
): Set<Tv>;
```




` Set `s don't have keys, so the `` Set `` values are used as the key in the
callback.




This method is like ` filterWithKey() `, but mutates the current `` Set `` too
in addition to returning the current ``` Set ```.




Future changes made to the current ` Set ` ARE reflected in the returned
`` Set ``, and vice-versa.




## Parameters




+ ` callable $callback ` - The callback containing the condition to apply to the
  current `` Set `` values.




## Returns




* ` Set<Tv> ` - Returns itself.
<!-- HHAPIDOC -->
