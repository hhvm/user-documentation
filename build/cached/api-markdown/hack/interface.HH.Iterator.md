``` yamlmeta
{
    "name": "HH\\Iterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Iterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterator"
}
```




For those entities that are ` Traversable `, the `` Iterator `` interfaces provides
the methods of iteration




If a class implements ` Iterator `, then it provides the infrastructure to be
iterated over using a `` foreach `` loop.




## Interface Synopsis




``` Hack
namespace HH;

interface Iterator implements Traversable, Iterator {...}
```




### Public Methods




+ [` ->current(): \Tv `](</hack/reference/interface/HH.Iterator/current/>)\
  ( excerpt from http://php
+ [` ->key() `](</hack/reference/interface/HH.Iterator/key/>)\
  ( excerpt from http://php
+ [` ->next(): \void `](</hack/reference/interface/HH.Iterator/next/>)\
  ( excerpt from http://php
+ [` ->rewind(): \void `](</hack/reference/interface/HH.Iterator/rewind/>)\
  ( excerpt from http://php
+ [` ->valid(): bool `](</hack/reference/interface/HH.Iterator/valid/>)\
  ( excerpt from http://php
<!-- HHAPIDOC -->
