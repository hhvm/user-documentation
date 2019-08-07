``` yamlmeta
{
    "name": "IndexAccess",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "IndexAccess"
}
```




The interface for mutable, keyed collections to enable setting and removing
keys




## Interface Synopsis




``` Hack
interface IndexAccess implements ConstIndexAccess {...}
```




### Public Methods




+ [` ->removeKey(Tk $k): this `](</hack/reference/interface/IndexAccess/removeKey/>)\
  Removes the specified key (and associated value) from the current
  collection
+ [` ->set(Tk $k, Tv $v): this `](</hack/reference/interface/IndexAccess/set/>)\
  Stores a value into the current collection with the specified key,
  overwriting the previous value associated with the key
+ [` ->setAll(?KeyedTraversable<Tk, Tv> $traversable): this `](</hack/reference/interface/IndexAccess/setAll/>)\
  For every element in the provided `` Traversable ``, stores a value into the
  current collection associated with each key, overwriting the previous value
  associated with the key
<!-- HHAPIDOC -->
