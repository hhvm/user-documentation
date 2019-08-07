``` yamlmeta
{
    "name": "remove",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Removes the specified key (and associated value) from the current ` Map `




``` Hack
public function remove(
  Tk $key,
): Map<Tk, Tv>;
```




This method is interchangeable with ` removeKey() `.




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` Tk $key `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




Since ` Map::remove() ` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $m ` itself, you can chain a bunch of `` remove() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/remove/001-basic-usage.php @@
<!-- HHAPIDOC -->
