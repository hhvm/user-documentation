``` yamlmeta
{
    "name": "addAll",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "OutputCollection"
}
```




For every element in the provided ` Traversable `, append a value into the
current collection




``` Hack
public function addAll(
  ?Traversable<Te> $traversable,
): this;
```




It returns the current collection, meaning changes made to the current
collection will be reflected in the returned collection.




## Parameters




+ ` ?Traversable<Te> $traversable ` - The `` Traversable `` with the new values to set. If
  ``` null ``` is provided, no changes are made.




## Returns




* ` this ` - Returns itself.
<!-- HHAPIDOC -->
