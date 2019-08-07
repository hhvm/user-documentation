``` yamlmeta
{
    "name": "MapAccess",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "MapAccess"
}
```




The interface for setting and removing ` Map ` keys (and associated values)




This interface provides no new methods as all current access for ` Map `s are
defined in its parent interfaces. But you could theoretically use this
interface for parameter and return type annotations.




## Interface Synopsis




``` Hack
interface MapAccess implements ConstMapAccess, SetAccess, IndexAccess,                                     SetAccess,                                     IndexAccess {...}
```



<!-- HHAPIDOC -->
