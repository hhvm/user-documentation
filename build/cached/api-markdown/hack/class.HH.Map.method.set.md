``` yamlmeta
{
    "name": "set",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Stores a value into the current ` Map ` with the specified key, overwriting
the previous value associated with the key




``` Hack
public function set(
  Tk $key,
  Tv $value,
): Map<Tk, Tv>;
```




This method is equivalent to ` Map::add() `. If the key to set does not exist,
it is created. This is inconsistent with, for example, `` Vector::set() ``
where if the key is not found, an exception is thrown.




` $map->set($k,$v) ` is equivalent to `` $map[$k] = $v `` (except that ``` set() ```
returns the current ```` Map ````).




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` Tk $key `
+ ` Tv $value `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




Since ` Map::set() ` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $m ` itself, you can chain a bunch of `` set() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/set/001-basic-usage.php @@
<!-- HHAPIDOC -->
