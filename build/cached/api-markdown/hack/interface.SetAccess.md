``` yamlmeta
{
    "name": "SetAccess",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "SetAccess"
}
```




The interface for mutable ` Set `s to enable removal of its values




## Interface Synopsis




``` Hack
interface SetAccess implements ConstSetAccess {...}
```




### Public Methods




+ [` ->remove(Tm $m): this `](</hack/reference/interface/SetAccess/remove/>)\
  Removes the provided value from the current `` Set ``
<!-- HHAPIDOC -->
