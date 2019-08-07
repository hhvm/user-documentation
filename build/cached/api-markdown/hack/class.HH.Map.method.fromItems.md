``` yamlmeta
{
    "name": "fromItems",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Creates a ` Map ` from the given `` Traversable ``, or an empty ``` Map ``` if
```` null ```` is passed




``` Hack
public static function fromItems(
  ?Traversable<Pair<Tk, Tv>> $iterable,
): Map<Tk, Tv>;
```




This is the static method version of the ` Map::__construct() ` constructor.




## Parameters




+ ` ?Traversable<Pair<Tk, Tv>> $iterable `




## Returns




* ` Map<Tk, Tv> ` - A `` Map `` with the key/value pairs from the ``` Traversable ```; or an
  empty ```` Map ```` if the ````` Traversable ````` is `````` null ``````.




## Examples




This example shows that a ` Map ` can be created from any `` Traversable `` of key-value pairs:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/fromItems/001-basic-usage.php @@
<!-- HHAPIDOC -->
