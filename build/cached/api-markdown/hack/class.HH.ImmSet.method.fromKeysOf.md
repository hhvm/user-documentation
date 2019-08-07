``` yamlmeta
{
    "name": "fromKeysOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Creates an ` ImmSet ` from the keys of the specified container




``` Hack
public static function fromKeysOf<Tk as arraykey>(
  ?KeyedContainer<Tk, mixed> $container,
): ImmSet<Tk>;
```




The keys of the container will be the values of the ` ImmSet `.




## Parameters




+ ` ?KeyedContainer<Tk, mixed> $container ` - The container with the keys used to create the
  `` ImmSet ``.




## Returns




* ` ImmSet<Tk> ` - An `` ImmSet `` built from the keys of the specified container.




## Examples




See [` Set::fromKeysOf `](</hack/reference/class/Set/fromKeysOf/#examples>) for usage examples.
<!-- HHAPIDOC -->
