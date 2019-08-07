``` yamlmeta
{
    "name": "ConstIndexAccess",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstIndexAccess"
}
```




The interface for all keyed collections to enable access its values




## Interface Synopsis




``` Hack
interface ConstIndexAccess {...}
```




### Public Methods




+ [` ->at(Tk $k): Tv `](</hack/reference/interface/ConstIndexAccess/at/>)\
  Returns the value at the specified key in the current collection
+ [` ->containsKey(mixed $k): bool `](</hack/reference/interface/ConstIndexAccess/containsKey/>)\
  Determines if the specified key is in the current collection
+ [` ->get(Tk $k): ?Tv `](</hack/reference/interface/ConstIndexAccess/get/>)\
  Returns the value at the specified key in the current collection
<!-- HHAPIDOC -->
