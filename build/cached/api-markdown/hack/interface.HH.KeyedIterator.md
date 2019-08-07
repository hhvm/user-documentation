``` yamlmeta
{
    "name": "HH\\KeyedIterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterator"
}
```




For those entities that are ` KeyedTraversable `, the `` KeyedIterator ``
interfaces provides the methods of iteration, included being able to get
the key




If a class implements ` KeyedIterator `, then it provides the infrastructure
to be iterated over using a `` foreach `` loop.




## Interface Synopsis




``` Hack
namespace HH;

interface KeyedIterator implements Iterator, KeyedTraversable {...}
```




### Public Methods




+ [` ->key(): \Tk `](</hack/reference/interface/HH.KeyedIterator/key/>)\
  Return the current key at the current iterator position
<!-- HHAPIDOC -->
