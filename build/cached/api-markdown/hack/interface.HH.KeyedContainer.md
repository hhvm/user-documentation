``` yamlmeta
{
    "name": "HH\\KeyedContainer",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Container.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedContainer"
}
```




Represents an entity that can be iterated over using ` foreach `, allowing
a key, except it does not include objects that implement `` KeyedIterator `` nor
``` Set ``` and ```` ImmSet ````




Additionally, represents an entity that can be indexed using square-bracket syntax




Square bracket syntax is:




```
$keyed_container[$key]
```




At this point, this includes entities with keys of ` int ` and `` string ``.




The iteration variables will have a type of ` Tk ` for the key and `` Tv `` for the
value.




In addition to Hack collections, PHP ` array `s are `` KeyedContainer ``s.




## Interface Synopsis




``` Hack
namespace HH;

interface KeyedContainer implements Container, Rx\KeyedTraversable, \\HH\Rx\KeyedTraversable {...}
```



<!-- HHAPIDOC -->
