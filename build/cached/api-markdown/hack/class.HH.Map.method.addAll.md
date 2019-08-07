``` yamlmeta
{
    "name": "addAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




For every element in the provided ` Traversable `, add a key/value pair into
the current `` Map ``




``` Hack
public function addAll(
  ?Traversable<Pair<Tk, Tv>> $iterable,
): Map<Tk, Tv>;
```




This method is equivalent to ` Map::setAll() `. If a key in the `` Traversable ``
exists in the ``` Map ```, then the value associated with that key in the ```` Map ````
is overwritten.




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` ?Traversable<Pair<Tk, Tv>> $iterable `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




The following example adds a collection of key-value pairs to the ` Map ` `` $m `` and also adds multiple collections of key-value pairs to ``` $m ``` through chaining. Since ```` Map::addAll() ```` returns a [shallow copy](<https://en.wikipedia.org/wiki/Object_copying#Shallow_copy>) of ` $m ` itself, you can chain a bunch of `` addAll() `` calls together.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/addAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
