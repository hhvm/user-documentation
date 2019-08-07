``` yamlmeta
{
    "name": "add",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Add a key/value pair to the end of the current ` Map `




``` Hack
public function add(
  Pair<Tk, Tv> $val,
): Map<Tk, Tv>;
```




This method is equivalent to ` Map::set() `. If the key in the  `` Pair ``
exists in the ``` Map ```,  the value associated with it is overwritten.




` $map->add($p) ` is equivalent to both `` $map[$k] = $v `` and
``` $map[] = Pair {$k, $v} ``` (except that ```` add() ```` returns the ````` Map `````).




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` Pair<Tk, Tv> $val `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




The following example adds a single key-value pair to the ` Map ` `` $m `` and also adds multiple key-value pairs to ``` $m ``` through chaining. Since ```` Map::add() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $m ` itself, you can chain a bunch of `` add() `` calls together, and that will add all those values to ``` $m ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/add/001-basic-usage.php @@
<!-- HHAPIDOC -->
