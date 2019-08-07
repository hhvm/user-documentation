``` yamlmeta
{
    "name": "HH\\Collection",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "HH\\Collection"
}
```




` Collection ` is the primary collection interface for mutable collections




Assuming you want the ability to clear out your collection, you would
implement this (or a child of this) interface. Otherwise, you can implement
` OutputCollection ` only. If your collection to be immutable, implement
`` ConstCollection `` only instead.




## Interface Synopsis




``` Hack
namespace HH;

interface Collection implements \ConstCollection, \OutputCollection, \                                 OutputCollection {...}
```




### Public Methods




+ [` ->clear() `](</hack/reference/interface/HH.Collection/clear/>)\
  Removes all items from the collection
<!-- HHAPIDOC -->
