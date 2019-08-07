``` yamlmeta
{
    "name": "add",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "OutputCollection"
}
```




Add a value to the collection and return the collection itself




``` Hack
public function add(
  Te $e,
): this;
```




It returns the current collection, meaning changes made to the current
collection will be reflected in the returned collection.




## Parameters




+ ` Te $e ` - The value to add.




## Returns




* ` this ` - The updated collection itself.
<!-- HHAPIDOC -->
