``` yamlmeta
{
    "name": "ConstMapAccess",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMapAccess"
}
```




The interface for enabling access to the ` Map `s values




This interface provides no new methods as all current access for ` Map `s are
defined in its parent interfaces. But you could theoretically use this
interface for parameter and return type annotations.




## Interface Synopsis




``` Hack
interface ConstMapAccess implements ConstSetAccess, ConstIndexAccess,                                           ConstIndexAccess {...}
```



<!-- HHAPIDOC -->
