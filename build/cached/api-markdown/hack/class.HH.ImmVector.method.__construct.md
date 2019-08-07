``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Creates an ` ImmVector ` from the given `` Traversable ``, or an empty
``` ImmVector ``` if ```` null ```` is passed




``` Hack
public function __construct(
  ?Traversable<Tv> $iterable = NULL,
): void;
```




## Parameters




+ ` ?Traversable<Tv> $iterable = NULL `




## Returns




* ` void `




## Examples




See [` Vector `](</hack/reference/class/Vector/__construct/#examples>) for usage examples.
<!-- HHAPIDOC -->
