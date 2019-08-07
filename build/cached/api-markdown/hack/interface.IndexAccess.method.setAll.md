``` yamlmeta
{
    "name": "setAll",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "IndexAccess"
}
```




For every element in the provided ` Traversable `, stores a value into the
current collection associated with each key, overwriting the previous value
associated with the key




``` Hack
public function setAll(
  ?KeyedTraversable<Tk, Tv> $traversable,
): this;
```




If a key is not present the current Vector that is present in the
` Traversable `, an exception is thrown. If you want to add a value even if a
key is not present, use `` addAll() ``.




It the current collection, meaning changes made to the current collection
will be reflected in the returned collection.




## Parameters




+ ` ?KeyedTraversable<Tk, Tv> $traversable ` - The `` Traversable `` with the new values to set. If
  ``` null ``` is provided, no changes are made.




## Returns




* ` this ` - Returns itself.
<!-- HHAPIDOC -->
