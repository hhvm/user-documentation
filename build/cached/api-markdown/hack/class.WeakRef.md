``` yamlmeta
{
    "name": "WeakRef",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/weakref/ext_weakref.php",
        "api-sources/hhvm/hphp/hack/hhi/weakref.hhi"
    ],
    "class": "WeakRef"
}
```




( excerpt from
http://php




net/manual/en/class.weakref.php )




The WeakRef class provides a gateway to objects without preventing the
garbage collector from freeing those objects. It also provides a way to turn
a weak reference into a strong one.




## Interface Synopsis




``` Hack
final class WeakRef {...}
```




### Public Methods




+ [` ->__construct(?T $reference) `](</hack/reference/class/WeakRef/__construct/>)\
  ( excerpt from
  http://php
+ [` ->acquire(): bool `](</hack/reference/class/WeakRef/acquire/>)\
  ( excerpt from
  http://php
+ [` ->get(): ?T `](</hack/reference/class/WeakRef/get/>)\
  ( excerpt from
  http://php
+ [` ->release(): bool `](</hack/reference/class/WeakRef/release/>)\
  ( excerpt from
  http://php
+ [` ->valid(): bool `](</hack/reference/class/WeakRef/valid/>)\
  ( excerpt from
  http://php
<!-- HHAPIDOC -->
