``` yamlmeta
{
    "name": "setAll",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




For every element in the provided ` Traversable `, stores a value into the
current `` Map `` associated with each key, overwriting the previous value
associated with the key




``` Hack
public function setAll(
  ?KeyedTraversable<Tk, Tv> $iterable,
): Map<Tk, Tv>;
```




This method is equivalent to ` Map::addAll() `. If a key to set does not
exist in the Map that does exist in the `` Traversable ``, it is created. This
is inconsistent with, for example, the method ``` Vector::setAll() ``` where if
a key is not found, an exception is thrown.




Future changes made to the current ` Map ` ARE reflected in the returned
`` Map ``, and vice-versa.




## Parameters




+ ` ?KeyedTraversable<Tk, Tv> $iterable `




## Returns




* ` Map<Tk, Tv> ` - Returns itself.




## Examples




This example shows how ` setAll() ` can be used with any `` KeyedTraversable ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/setAll/001-basic-usage.php @@
<!-- HHAPIDOC -->
