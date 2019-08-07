``` yamlmeta
{
    "name": "removeKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Removes the specified key (and associated value) from the current ` Map `




``` Hack
public function removeKey(
  Tk $key,
): Map<Tk, Tv>;
```




This method is interchangeable with ` remove() `.




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` Tk $key `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




Since ` Map::removeKey() ` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $m ` itself, you can chain a bunch of `` removeKey() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/removeKey/001-basic-usage.php @@
<!-- HHAPIDOC -->
