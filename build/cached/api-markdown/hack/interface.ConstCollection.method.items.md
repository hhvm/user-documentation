``` yamlmeta
{
    "name": "items",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstCollection"
}
```




Get access to the items in the collection




``` Hack
public function items(): HH\Rx\Iterable<Te>;
```




Can be empty.




## Returns




+ ` HH\Rx\Iterable<Te> ` - Returns an `` Iterable `` with access to all of the items in
  the collection.
<!-- HHAPIDOC -->
