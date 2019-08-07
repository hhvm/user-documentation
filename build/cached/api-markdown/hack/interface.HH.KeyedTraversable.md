``` yamlmeta
{
    "name": "HH\\KeyedTraversable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Traversable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedTraversable"
}
```




Represents an entity that can be iterated over using ` foreach `, allowing
a key




The iteration variables will have a type of ` Tk ` for the key and `` Tv `` for the
value.




In addition to Hack collections, PHP ` array `s and anything that implement
`` KeyedIterator `` are ``` KeyedTraversable ```.




In general, if you are implementing your own Hack class, you will want to
implement ` KeyedIterable ` instead of `` KeyedTraversable `` since
``` KeyedTraversable ``` is more of a bridge for PHP ```` array ````s to work well with
Hack collections.




## Interface Synopsis




``` Hack
namespace HH;

interface KeyedTraversable implements Traversable {...}
```



<!-- HHAPIDOC -->
