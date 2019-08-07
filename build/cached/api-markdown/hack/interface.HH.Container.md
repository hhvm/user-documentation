``` yamlmeta
{
    "name": "HH\\Container",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Container.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Container"
}
```




Represents an entity that can be iterated over using ` foreach `, without
requiring a key, except it does not include objects that implement
`` Iterator ``




The iteration variable will have a type of ` T `.




In addition to Hack collections, PHP ` array `s are `` Container ``s.




## Interface Synopsis




``` Hack
namespace HH;

interface Container implements Rx\Traversable, \\HH\Rx\Traversable {...}
```



<!-- HHAPIDOC -->
