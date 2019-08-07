``` yamlmeta
{
    "name": "fromItems",
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
public static function fromItems(
  ?Traversable<Tv> $iterable,
): ImmSet<Tv>;
```




This is the static method version of the ` ImmSet::__construct() `
constructor.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` with the values from the ``` Traversable ```; or an empty
  ```` ImmSet ```` if the ````` Traversable ````` is `````` null ``````.




## Examples




See [` Set::fromItems `](</hack/reference/class/Set/fromItems/#examples>) for usage examples.
<!-- HHAPIDOC -->
