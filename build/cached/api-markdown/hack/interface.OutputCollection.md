``` yamlmeta
{
    "name": "OutputCollection",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "OutputCollection"
}
```




The interface implemented for a mutable collection type so that values can
be added to it




## Interface Synopsis




``` Hack
interface OutputCollection {...}
```




### Public Methods




+ [` ->add(Te $e): this `](</hack/reference/interface/OutputCollection/add/>)\
  Add a value to the collection and return the collection itself
+ [` ->addAll(?Traversable<Te> $traversable): this `](</hack/reference/interface/OutputCollection/addAll/>)\
  For every element in the provided `` Traversable ``, append a value into the
  current collection
<!-- HHAPIDOC -->
