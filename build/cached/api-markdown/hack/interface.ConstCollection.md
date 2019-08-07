``` yamlmeta
{
    "name": "ConstCollection",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstCollection"
}
```




The base interface implemented for a collection type so that base information
such as count and its items are available




Every concrete class indirectly
implements this interface.




## Interface Synopsis




``` Hack
interface ConstCollection implements HH\Rx\Countable {...}
```




### Public Methods




+ [` ->count(): int `](</hack/reference/interface/ConstCollection/count/>)\
  Get the number of items in the collection

+ [` ->isEmpty(): bool `](</hack/reference/interface/ConstCollection/isEmpty/>)\
  Is the collection empty?

+ [` ->items(): HH\Rx\Iterable<Te> `](</hack/reference/interface/ConstCollection/items/>)\
  Get access to the items in the collection

+ [` ->toDArray(): darray `](</hack/reference/interface/ConstCollection/toDArray/>)

+ [` ->toVArray(): varray `](</hack/reference/interface/ConstCollection/toVArray/>)

<!-- HHAPIDOC -->
