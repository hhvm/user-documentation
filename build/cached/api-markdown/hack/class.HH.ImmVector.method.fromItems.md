``` yamlmeta
{
    "name": "fromItems",
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
public static function fromItems(
  ?Traversable<Tv> $iterable,
): ImmVector<Tv>;
```




This is the static method version of the ` ImmVector::__construct() `
constructor.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` ImmVector<Tv> ` - An `` ImmVector `` with the values from the ``` Traversable ```; or an
  empty ```` ImmVector ```` if the ````` Traversable ````` is `````` null ``````.




## Examples




See [` Vector::fromItems `](</hack/reference/class/Vector/fromItems/#examples>) for usage examples.
<!-- HHAPIDOC -->
