``` yamlmeta
{
    "name": "fromItems",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Creates an ` ImmMap ` from the given `` Traversable ``, or an empty ``` ImmMap ```
if ```` null ```` is passed




``` Hack
public static function fromItems(
  ?Traversable<Pair<Tk, Tv>> $iterable,
):     ImmMap<Tk, Tv>;
```




This is the static method version of the ` ImmMap::__construct() `
constructor.




## Parameters




+ ` ?Traversable<Pair<Tk, Tv>> $iterable `




## Returns




* ` ImmMap<Tk, Tv> ` - An `` ImmMap `` with the key/value pairs from the ``` Traversable ```; or
  an empty ```` ImmMap ```` if the ````` Traversable ````` is `````` null ``````.




## Examples




See [` Map::fromItems `](</hack/reference/class/Map/fromItems/#examples>) for usage examples.
<!-- HHAPIDOC -->
