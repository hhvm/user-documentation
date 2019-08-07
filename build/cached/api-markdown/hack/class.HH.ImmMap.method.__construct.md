``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmMap.hhi"
    ],
    "class": "HH\\ImmMap"
}
```




Creates an ` ImmMap ` from the given `` KeyedTraversable ``, or an empty
``` ImmMap ``` if ```` null ```` is passed




``` Hack
public function __construct(
  ?KeyedTraversable<Tk, Tv> $iterable = NULL,
): void;
```




## Parameters




+ ` ?KeyedTraversable<Tk, Tv> $iterable = NULL `




## Returns




* ` void `




## Examples




See [` Map::__construct `](</hack/reference/class/Map/__construct/#examples>) for usage examples.
<!-- HHAPIDOC -->
