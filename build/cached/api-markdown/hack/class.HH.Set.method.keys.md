``` yamlmeta
{
    "name": "keys",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns a ` Vector ` containing the values of the current `` Set ``




``` Hack
public function keys(): Vector<arraykey>;
```




` Set `s don't have keys, so this will return the values.




This method is interchangeable with ` toVector() ` and `` values() ``.




## Returns




+ ` Vector<arraykey> ` - a `` Vector `` (integer-indexed) containing the values of the
  current ``` Set ```.




## Examples




This example shows that ` keys() ` returns a `` Vector `` of the ``` Set ```'s values because ```` Set ````s don't have keys:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/keys/001-basic-usage.php @@
<!-- HHAPIDOC -->
