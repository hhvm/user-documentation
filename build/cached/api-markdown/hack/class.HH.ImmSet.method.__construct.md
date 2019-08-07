``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Creates an ` ImmSet ` from the given `` Traversable ``, or an empty ``` ImmSet ``` if
```` null ```` is passed




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




See [` Set `](</hack/reference/class/Set/__construct/#examples>) for usage examples.
<!-- HHAPIDOC -->
