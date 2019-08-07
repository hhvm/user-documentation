``` yamlmeta
{
    "name": "fromKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmVector.hhi"
    ],
    "class": "HH\\ImmVector"
}
```




Creates an ` ImmVector ` from the keys of the specified container




``` Hack
public static function fromKeysOf<Tk as arraykey>(
  ?KeyedContainer<Tk, mixed> $container,
): ImmVector<Tk>;
```




Every key in the provided ` KeyedContainer ` will appear sequentially in the
returned `` ImmVector ``, with the next available integer key assigned to each.




## Parameters




+ ` ?KeyedContainer<Tk, mixed> $container ` - The container with the keys used to create the
  current `` ImmVector ``.




## Returns




* ` ImmVector<Tk> ` - An `` ImmVector `` built from the keys of the specified container.




## Examples




See [` Vector::fromKeysOf `](</hack/reference/class/Vector/fromKeysOf/#examples>) for usage examples.
<!-- HHAPIDOC -->
